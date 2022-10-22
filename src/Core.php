<?php

declare(strict_types=1);

namespace FFSWM;

use FFSWM\Backend\X11\FFIWrapper;

class Core
{
    public $display;

    public function init()
    {
        $display = ":1";
        $connection = FFIWrapper::xcb_connect($display, null);
        $setup = FFIWrapper::xcb_get_setup($connection);
        $iterator = FFIWrapper::xcb_setup_roots_iterator($setup);
        $screen = $iterator->data;
        $window = $screen->root;
        $foreground = FFIWrapper::xcb_generate_id($connection);
        $mask = 4 | 65536;
        $values = \FFI::new("uint32_t[2]");
        $values[0] = $screen->black_pixel;
        $values[1] = 0;
        FFIWrapper::xcb_create_gc($connection, $foreground, $window, $mask, $values);
        $window = FFIWrapper::xcb_generate_id($connection);

        $mask = 2 | 2048;
        $values[0] = $screen->white_pixel;
        $values[1] = 32768;

        FFIWrapper::xcb_create_window(
            $connection,
            0,
            $window,
            $screen->root,
            0,0,
            150, 150,
        10,
        1,
        $screen->root_visual,
        $mask, $values
        );
        FFIWrapper::xcb_map_window($connection, $window);
//        xcb_gcontext_t xcb_generate_id (xcb_connection_t *c);

        FFIWrapper::xcb_flush($connection);
        sleep(10);

        FFIWrapper::xcb_disconnect($connection);

        //        $

//        $screen = DefaultScreen($this->display);
    }
}
