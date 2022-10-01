<?php  
    //get category id in array
    $category_id = json_decode($section_item->item_id);
    $categories = App\Models\Category::whereIn('id', $category_id)->get();
?>
@if(count($categories) && count($category_id) > 1)
<style>
.product-tag {
    color: #000;
    border-color: #f5f5f5;
    background-color: #f5f5f5;
    padding: 5px 20px;
    font-size: 18px;
    cursor: pointer;
    margin-right: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    font-weight: bold;
}
.product-tag:hover, .list-style li:active{border-color: #fedb43;
    background-color: #fedb43;
    color: #222;}
    .list-style li.active{border-color: #fedb43;
    background-color: #fedb43;
    color: #222;}
    .list-style{display:flex; flex-grow: 1;padding-left: 0;
    white-space: nowrap;
    overflow-x: auto;line-height: 28px;
    overflow-y: hidden;list-style:none;}
    .list-style::-webkit-scrollbar { 
    display: none;scrollbar-width: none;  /* Safari and Chrome */
}
</style>

<ul class="list-style">
    <input type="hidden" id="categoryId{{$section_item->id}}" value="0">
    @foreach($categories as $category)
    <li onclick="productTag({{$category->id}}, {{$section_item->id}})" class="product-tag tag{{$category->id}} @if($category->id == $category_id[0]) active @endif">{{$category->category_bd}}</li>
    @endforeach
</ul>
    
<script type="text/javascript">

    var page = 1;
    var category = 0;
    function productTag(category, section_id)
    {
    var tabLink = document.querySelectorAll('.product-tag');
    
    for(var i = 0; i < tabLink.length; i++){
        tabLink[i].classList.remove("active");
    }
    document.querySelector('.tag'+category).classList.add('active');
 
    page = 1;
    document.querySelector('#categoryId'+section_id).value = category;
    // $('#load_more_button'+section_id).html("<div class='loadingData-sm'></div>");
  
      $.ajax({
        url: '{{route("getNewsByCategory")}}',
        method:"get",
        data:{
               category:category,section_id:section_id, filter:'filter'
            },
        success:function(data)
        { 
            // $('#load_more_button'+section_id).remove();
            $('#post_data'+section_id).html(data);
        }
      })
    }
</script>
@endif
