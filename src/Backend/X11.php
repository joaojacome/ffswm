<?php

declare(strict_types=1);

namespace FFSWM\Backend;

class X11
{
    public \FFI $ffi;
    public function __construct()
    {
        $this->ffi = \FFI::cdef(<<<C
typedef uint32_t xcb_window_t;
typedef uint8_t xcb_keycode_t;
typedef uint32_t xcb_visualid_t;
typedef uint32_t xcb_drawable_t;
typedef struct xcb_connection_t xcb_connection_t;
typedef struct {
    unsigned int sequence;  /**< Sequence number */
} xcb_void_cookie_t;
typedef struct xcb_setup_t {
    uint8_t       status;
    uint8_t       pad0;
    uint16_t      protocol_major_version;
    uint16_t      protocol_minor_version;
    uint16_t      length;
    uint32_t      release_number;
    uint32_t      resource_id_base;
    uint32_t      resource_id_mask;
    uint32_t      motion_buffer_size;
    uint16_t      vendor_len;
    uint16_t      maximum_request_length;
    uint8_t       roots_len;
    uint8_t       pixmap_formats_len;
    uint8_t       image_byte_order;
    uint8_t       bitmap_format_bit_order;
    uint8_t       bitmap_format_scanline_unit;
    uint8_t       bitmap_format_scanline_pad;
    xcb_keycode_t min_keycode;
    xcb_keycode_t max_keycode;
    uint8_t       pad1[4];
} xcb_setup_t;
typedef uint32_t xcb_colormap_t;
typedef uint32_t xcb_gcontext_t;
xcb_gcontext_t xcb_generate_id (xcb_connection_t *c);
xcb_void_cookie_t xcb_create_gc (xcb_connection_t *c,
               xcb_gcontext_t    cid,
               xcb_drawable_t    drawable,
               uint32_t          value_mask,
               const void       *value_list);
typedef struct xcb_screen_t {
    xcb_window_t   root;
    xcb_colormap_t default_colormap;
    uint32_t       white_pixel;
    uint32_t       black_pixel;
    uint32_t       current_input_masks;
    uint16_t       width_in_pixels;
    uint16_t       height_in_pixels;
    uint16_t       width_in_millimeters;
    uint16_t       height_in_millimeters;
    uint16_t       min_installed_maps;
    uint16_t       max_installed_maps;
    xcb_visualid_t root_visual;
    uint8_t        backing_stores;
    uint8_t        save_unders;
    uint8_t        root_depth;
    uint8_t        allowed_depths_len;
} xcb_screen_t;
typedef struct xcb_screen_iterator_t {
    xcb_screen_t *data;
    int           rem;
    int           index;
} xcb_screen_iterator_t;
xcb_void_cookie_t
xcb_map_window (xcb_connection_t *c,
                xcb_window_t      window);
int xcb_flush(xcb_connection_t *c);
void xcb_disconnect(xcb_connection_t *c);

xcb_screen_iterator_t xcb_setup_roots_iterator (const xcb_setup_t *R);
        
        const struct xcb_setup_t *xcb_get_setup(xcb_connection_t *c);
        uint32_t xcb_generate_id(xcb_connection_t *c);
xcb_void_cookie_t
xcb_create_window (xcb_connection_t *c,
                   uint8_t           depth,
                   xcb_window_t      wid,
                   xcb_window_t      parent,
                   int16_t           x,
                   int16_t           y,
                   uint16_t          width,
                   uint16_t          height,
                   uint16_t          border_width,
                   uint16_t          _class,
                   xcb_visualid_t    visual,
                   uint32_t          value_mask,
                   const void       *value_list);

        xcb_connection_t *xcb_connect(const char *displayname, int *screenp);
        const struct xcb_setup_t *xcb_get_setup(xcb_connection_t *c);
C
        , '/nix/store/whpvwywwfws4cp7rc9mp4v7ga1lkf3w3-libxcb-1.14/lib/libxcb.so');
    }

}
