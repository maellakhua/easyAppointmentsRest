<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Providers extends REST_Controller {

    function all_get() {

        $this->load->model('providers_model');
        $providers = $this->providers_model->get_batch('');

        if($providers)
        {
            $this->response($providers, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any providers!'), 404);
        }
    }

    //Get a specific provider by id
    function by_id_get() {

        if(empty($this->get('id'))) {
            $this->response(array('error' => 'Bad request!'), 400);
        }

        $this->load->model('providers_model');
        $provider = $this->providers_model->get_provider_by_id($this->get('id'));


        if($provider) {
            $this->response($provider, 200); // 200 being the HTTP response code
        }
        else {
            $this->response(array('error' => 'This service could not be found'), 404);
        }
    }

    //Get a specific provider by price
    function by_price_get() {

        if(empty($this->get('price'))) {
            $this->response(array('error' => 'Bad request!'), 400);
        }

        $this->load->model('providers_model');
        $providers = $this->providers_model->get_providers_by_price($this->get('price'));


        if($providers) {
            $this->response($providers, 200); // 200 being the HTTP response code
        }
        else {
            $this->response(array('error' => 'This service could not be found'), 404);
        }
    }
}