<?php

namespace ICE\FlashMessageBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session;

/**
 * The FlashMessage extension renders flash messages set both in Symfony's session service
 * and allows settings flash messages in javascript or using twig function.
 * 
 * @author Niels Krijger <niels@kryger.nl>
 */
class FlashMessageExtension extends \Twig_Extension
{
    /**
     * @var Session
     */
    protected $session;
    
    /**
     * Creates a new FlashMessageExtension
     * 
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'showFlashMessages' => new \Twig_Function_Method($this, 'showFlashMessages', array('is_safe' => array('html'))),
            'flash' => new \Twig_Function_Method($this, 'flash', array('is_safe' => array('html'))),
        );
    }

    public function showFlashMessages()
    {
        $return = '<div id="flashmessages"></div>';
        $return .= $this->renderFlashJavascript($this->session->getFlashes());
        return $return;
    }
    
    public function flash($type, $message)
    {
        return $this->renderFlashJavascript(array($type => $message));
    }
    
    /**
     * Generates HTML for flash message call to the jQuery.flash(...) function.
     * This method returns the enclosing <script></script> tags as well.
     * 
     * @param array $messages
     */
    protected function renderFlashJavascript($messages) 
    {
        $return = "";
        if (count($this->session->getFlashes()) > 0) {
            $return .= '<script language="javascript">$(function () {';
            foreach ($messages as $type => $message) {
                $return .= '$.flash({ type: "' . addslashes($type) . '", message: "' . addslashes($message) . '" });';
            }
            $return .= '});</script>';
        }
        return $return;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'flashmessage';
    }
}
