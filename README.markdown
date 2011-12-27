FlashMessage Bundle
===================

The FlashMessage bundle is a basic script that allows you to show typical brief 
success or error messages after a user action. This plugin comes with four pre-styled message 
types: 'success', 'notice', 'warning' and 'error'. 

Features:
    
 * renders the standard Symfony session component flash messages.
 * a twig extension making it easy to show manual messages if you want to.
 * a javascript interface enabling you to show flash messages without reloading.
 
Dependencies:
    
 * Symfony session component
 * jQuery 1.4.2 (other versions are likely to work as well)

Installation
------------

  1. Add this bundle to your vendor/dir using the vendors script:

    Add the following lines in your ``deps`` file:

        [ICEFlashMessageBundle]
            git=git://github.com/nielskrijger/FlashMessageBundle.git
            target=/bundles/ICE/FlashMessageBundle

    Run the vendors script:

        php bin/vendors install

  2. Add the ICE namespace to your autoloader:

        // app/autoload.php
        $loader->registerNamespaces(array(
            'ICE' => __DIR__.'/../vendor/bundles',
        ));

  3. Add this bundle to your application's kernel:

        // app/AppKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new ICE\FlashMessageBundle\ICEFlashMessageBundle(),
                // ...
            );
        }

  4. Configure the `ice_flash_message` service in your config.yml:

        ice_flash_message: ~

  5. Add the following files to the headof your main template:

        <link rel="stylesheet" href="{{ asset('bundles/iceflashmessage/css/jquery.flashMessage.css') }}" type="text/css" media="all" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="{{ asset('bundles/iceflashmessage/js/jquery.flashMessage.js') }}"></script>

  6. Call twig function where you want to show the flash messages: 

        # bundle/Resources/views/template.html.twig
        {{ showFlashMessages() }}

### Creating a flash message

You are advised to use the either one of the four flash message types: 'error', 'warning', 
'notice', and 'success'. If you pass any other type it is set as the className of the 
message's enclosing div. 

By default all messages passed to the session are rendered by the FlashMessage bundle. To add 
a flash message you can use the Symfony session service:

    # bundle/Controller/MyController.php
    $this->get('session')->setFlash('success', 'Well done! You\'ve been initialized');

The symfony session service renders the message after a new page request. If you want to show a
flash message immediately you can render it in the template directly:

    # bundle/Resources/views/template.html.twig
    {{ flash('success', 'Scotty has beamed you up!') }}

Alternatively you can render a flash message in javascript after for example an ajax request:
 
    # bundle/Resources/views/template.html.twig
    <script language="javascript">
    $(function () {
        $.flash({ type: "success", message: "You are a success!" });  
    });
    </script>

jQuery Flash parameters
-----------------------

The jQuery function $.flash accepts the following parameters:

 * __key__: message, __type__: string, __default__: "No message set"
 * __key__: type, __type__: string, __default__: "success"

Credits
-------

The icons are from the excellent FamFamFam icon set by Mark James.