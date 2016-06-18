<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

use Philo\Blade\Blade;

/**
 * Class BB_Controller
 */
class BB_Controller extends MX_Controller
{
    /**
     * @var Blade
     */
    protected $blade;

    /**
     * @var
     */
    protected $module;

    /**
     * @var string
     */
    protected $views;

    /**
     * @var string
     */
    protected  $cache;

    /**
     * @var
     */
    protected static $profiler = FALSE;

    /**
     * BB_Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(self::$profiler === TRUE)
        {
            $this->output->enable_profiler(TRUE);
        }

        $this->views = $this->module . "/views";
        $this->cache = $this->module . "/cache";
        $this->blade = new Blade($this->views, $this->cache);
    }
}