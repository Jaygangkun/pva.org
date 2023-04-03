<div class="searchBlock">
    <form role="search" action="{{home_url('/research-resources/publication/publications-search/')}}" method="get" id="searchform">
        <input type="text" name="searchtext" value="{{str_replace("+"," ",$_GET['searchtext'])}}" />
        <input type="submit" alt="Search" value="Search" class="btn btn-primary" />
    </form>
</div>