<?php
namespace Services\Controller\API;

class SoapExceptionHandler
{
    private $exposeExceptionMessages = array(
        'MyProject\DomainException',
    );

    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function __call($method, $args)
    {
        try {
            return call_user_func_array(
                array($this->service, $method),
                $args
            );
        } catch (\Exception $e) {
            // log errors here as well!
            if (in_array(get_class($e), $this->exposeExceptionMessages)) {
                throw new \SoapFault('SERVER', $e->getMessage());
            }

            throw new \SOAPFault('SERVER', 'Application Error');
        }
    }
}

?>