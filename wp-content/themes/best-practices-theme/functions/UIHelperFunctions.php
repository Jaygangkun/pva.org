<?php

if (! function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \Exception
     */
    function mix($path)
    {
        static $manifests = [];
        if (strpos($path, '/') !== 0) {
            $path = '/'.$path;
        }
        /*if (file_exists(public_path($manifestDirectory.'/hot'))) {
            return new HtmlString("//localhost:8080{$path}");
        }*/
        $manifestPath = dirname(__DIR__).'/public/mix-manifest.json';
        if (! isset($manifests[$manifestPath])) {
            if (! file_exists($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.' . $manifestPath);
            }
            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }
        $manifest = $manifests[$manifestPath];
        if (! isset($manifest[$path])) {
            throw new Exception("Unable to locate Mix file: {$path}.");
        }
        return public_path($manifest[$path]);
    }

    /**
     * Get the path to the specified file in the public assets folder (/public)
     *
     * @param string $path
     * @return string
     */
    function public_path($path) {
        return get_stylesheet_directory_uri().'/public/'.$path;
    }

    function pagination_bar( $custom_query ) {

        $total_pages = $custom_query->max_num_pages;
        $big = 999999999; // need an unlikely integer

        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));

            echo paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $total_pages,
            ));
        }
    }}