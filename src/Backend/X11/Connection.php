<?php

declare(strict_types=1);

namespace FFSWM\Backend\X11;

class Connection
{
    public mixed $connection;
    public mixed $setup;

    /**
     * @var array<Screen>
     */
    public array $screens = [];

    public function __construct(
        public readonly FFIWrapper $ffi,
        public readonly string     $displayName
    )
    {
        $this->connection = $this->ffi->xcb_connect($this->displayName, null);
        $this->setup = $this->ffi->xcb_get_setup($this->connection);
        foreach ($this->setup->roots as $screen) {
            $this->screens[] = new Screen($this, $screen);
        }
    }
}