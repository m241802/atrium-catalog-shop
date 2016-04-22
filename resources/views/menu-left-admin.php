<div  class="admin-left-menu">
    <ul>
        <ul class="images-menu-item">
            <li><a href="/admin/images/">Images</a></li>
            <li><a href="/admin/upload-file/">Create new image</a></li>
        </ul>
        <ul class="slides-menu-item">
            <li><a href="/admin/slider/">Slider</a></li>
            <li><a href="/admin/slide-create/">Create new slide</a></li>
        </ul>
        <ul class="news-menu-item">
            <li><a href="/admin/news/">News</a></li>
            <li><a href="/admin/news/create/">Create new</a></li>
        </ul>
        <ul class="posts-menu-item">
            <li><a href="/admin/posts/">Posts</a></li>
            <li><a href="/admin/posts/create/">Create post</a></li>
        </ul>
        <ul class="faqs-menu-item">
            <li><a href="/admin/faqs/">Faqs</a></li>
            <li><a href="/admin/faqs/create/">Create faq</a></li>
        </ul>
        <ul class="products-menu-item">
            <li><a href="/admin/shop/">Products</a></li>
            <li><a href="/admin/shop/create/">Create new product</a></li>
            <li><a href="/admin/categories/">Categories</a></li>
            <li><a href="/admin/category-create/">Create new category</a></li>
            <li><a href="/admin/attr-products/">Attributes product</a></li>
            <li><a href="/admin/create-attr/">Create new attribute product</a></li>
        </ul>
        <ul class="export-import-menu-item">
            <li><a href="/admin/export-import/">export-import</a></li>
        </ul>
        <ul class="auth-menu-item">
            <li><a href="/auth/register">register</a></li>
            @if (Auth::guest())
                <li><a href="/auth/login">Login</a></li>                        
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><% Auth::user()->name %> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
            @endif
            <li><a href="/">Home</a></li>
        </ul>
    </ul>
</div>