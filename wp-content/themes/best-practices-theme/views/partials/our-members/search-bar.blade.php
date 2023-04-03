<div class="container inner-top-xs members">
    <div class="row">
        <div class="col-md-6">
            <h2 class="text-left white primary-background-heading">Search Our Members Stories</h2>
        </div>
        <div class="col-md-6">
            <div class="navbar-form search results members">
                <form role="search" action="{{rtrim(get_permalink($post->ID), '/') . '/member-search/'}}" method="get" id="searchform">
                    <div id="" class="searchBox">
                        <label for="" id="" style="display:none;">Search for:</label>
                        <input name="searchtext" type="text" maxlength="1000" id="" class="form-control">
                        <input type="submit" name="" value="Search" id="" class="btn btn-default btn-submit icon-right-open">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>