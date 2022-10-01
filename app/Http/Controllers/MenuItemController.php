<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Menuitem;
use Session;
class MenuItemController extends Controller
{
  public function index(Request $request){
    
    $desiredMenu = '';  
    $data['menus'] = Menu::where('type', 'megaMenu')->get();
    if($request->menu && $request->menu != 'new'){
    
      $desiredMenu = Menu::where('id', $request->menu)->first();
      $data['menuitems'] = Menuitem::with('subMenus.childMenus')->whereNull('parent_id')->where('menu_id',$desiredMenu->id)->orderby('position', 'asc')->get();    
      
    }else{
      $data['menuitems'] = [];
    }


    $data['categories'] = Category::with('subcategory')->where('parent_id', null)->get();
    $data['pages'] = Page::where('status', 1)->get();
   
    $data['desiredMenu'] = $desiredMenu;
    return view ('backend.menu.menulist')->with($data);
  } 

  public function store(Request $request){
  
    $menu = new Menu();
    $menu->name = $request->name;
    $menu->type = 'megaMenu';
    $store = $menu->save();
    if($store){ 
      session::flash('success','Menu saved successfully !');   
      $url = route('menuBuilder')."?menu=".$menu->id;        
      return redirect($url);
    }else{
      return redirect()->back()->with('error','Failed to save menu !');
    }
  } 

  public function addItemToMenu(Request $request){

    $menuid = $request->menuid;
    $ids = $request->ids;
    $menu = Menu::findOrFail($menuid);
    if($menu){
      if($request->sourch == 'category'){
        if($request->ids && count($request->ids)>0){
          foreach($ids as $id){
            $category = Category::where('id',$id)->first();
            $menuItem = new Menuitem();
            $menuItem->title = $category->category_bd;
            $menuItem->url = 'category/'.$category->slug;
            $menuItem->sourch = 'category';
            $menuItem->parent_id = null;
            $menuItem->menu_id = $menuid;
            $menuItem->save();
          }
        }
        if($request->subids && count($request->subids)>0){
        
          foreach($request->subids as $id){
            $category = Category::where('id',$id)->first();
            $menuItem = new Menuitem();
            $menuItem->title = $category->category_bd;
            $menuItem->url = 'category/'.$category->slug;
            $menuItem->sourch = 'category';
            $menuItem->parent_id = null;
            $menuItem->menu_id = $menuid;
            $menuItem->save();
          }
        }

        if($request->childids && count($request->childids)>0){
        
          foreach($request->childids as $id){
            $category = Category::where('id',$id)->first();
            $menuItem = new Menuitem();
            $menuItem->title = $category->category_bd;
            $menuItem->url = 'category/'.$category->slug;
            $menuItem->sourch = 'category';
            $menuItem->parent_id = null;
            $menuItem->menu_id = $menuid;
            $menuItem->save();
          }
        }
      
      }elseif($request->sourch == 'page'){
        foreach($ids as $id){
          $page = Page::where('id',$id)->first();
          $menuItem = new Menuitem();
          $menuItem->title = $page->page_name_bd;
          $menuItem->url = $page->page_slug;
          $menuItem->sourch = 'page';
          $menuItem->parent_id = null;
          $menuItem->menu_id = $menuid;
          $menuItem->save();
        }
      }
      elseif($request->sourch == 'banner'){
          foreach($ids as $id){
            $banner = Banner::where('id',$id)->first();
            $menuItem = new Menuitem();
            $menuItem->title = $banner->title;
            $menuItem->url = $banner->id;
            $menuItem->sourch = 'banner';
            $menuItem->parent_id = null;
            $menuItem->menu_id = $menuid;
            $menuItem->save();
          }
      }else{
          $menuItem = new Menuitem();
          $menuItem->title = $request->link;
          $menuItem->url = $request->url;
          $menuItem->sourch = 'custom';
          $menuItem->parent_id = null;
          $menuItem->menu_id = $menuid;
          $menuItem->save();
        }
    }else{
      return redirect()->route('menuBuilder')->with('error','Menu not found.');
    }
    return redirect()->back()->with('success','Menu update successfully');
  }


  public function updateMenu(Request $request){

    $menu = Menu::find($request->menuid);
    $menu->location = $request->location;
    $menu->save();
    $menuItemOrder = json_decode($request->input('itemids'));
    $this->orderMenu($menuItemOrder, null);
  }

  private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::findOrFail($menuItem->id);
            $item->position = $index + 1;
            $item->parent_id = $parentId;
            $item->save();
            //if set child re-call function
            if(isset($menuItem->children)) {
              $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

  public function updateMenuItem(Request $request, $id){
    
    $item = Menuitem::find($id);
    $item->title = $request->title;
    $item->title_hidden = ($request->title_hidden) ? 1 : null;
    $item->url = ($request->url) ? $request->url : $item->url ;
    $item->menu_type = ($request->menu_type) ? $request->menu_type : null;
    $item->menu_width = ($request->menu_width) ? $request->menu_width : null;
    $item->target = $request->target;
    $item->save();
    return redirect()->back();
  }

  public function deleteMenuItem($id){        
    $menuitem = Menuitem::where('id',$id)->delete();
    if($menuitem ){
    $output = [
            'status' => true,
            'msg' => 'Item deleted successfully.'
        ];
    }else{
        $output = [
            'status' => false,
            'msg' => 'Item cannot deleted.'
        ];
      }
    return response()->json($output);
  } 

  public function destroy(Request $request, $id){
    Menuitem::where('menu_id',$id)->delete();  
    Menu::findOrFail($id)->delete();
    return redirect()->route('menuBuilder')->with('success','Menu deleted successfully');
  }     
}
