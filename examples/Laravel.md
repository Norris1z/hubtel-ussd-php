```php
  //routes.php

  Route::post('/','USSDController');
  
  
  //USSDController.php
  <?php
    namespace App\Http\Controllers;

    use Hubtel\USSD\USSD;
    use Hubtel\USSD\Request as USSDRequest; //Alias to prevent name collision with Laravel's Request
    use App\Sequences\{Sequence1,Sequence2,Sequence3}; //PHP 7+
    use Illuminate\Http\Request;

    class USSDController extends Controller
    {
        public function __invoke(Request $request) {
            return USSD::process(USSDRequest::createInstance(... array_values($request->toArray())),[
                new Sequence1(),
                new Sequence2(),
                new Sequence3()
            ])->toArray();
        }
    }

    /**
     * In this example we use to toArray because Laravel converts all array responses to Json.
     * To use the toJson method on the Hubtel\USSD\Response, you must explicitly specify your content type
     **/
     
    Sequence1.php
    <?php

    namespace App\Sequences;

    use Hubtel\USSD\Request;
    use Hubtel\USSD\RequestTypes;
    use Hubtel\USSD\Response;
    use Hubtel\USSD\SequenceInterface;

    class Sequence1 implements SequenceInterface
    {

        public function handle(Request $request)
        {
            return Response::createInstance('Welcome to Freebie Service.\n1. Free Food\n2. Free Drink\n3. Free Airtime',RequestTypes::RESPONSE);
        }
    }

    Sequence2.php
    <?php

    namespace App\Sequences;

    use Hubtel\USSD\Request;
    use Hubtel\USSD\RequestTypes;
    use Hubtel\USSD\Response;
    use Hubtel\USSD\SequenceInterface;

    class Sequence2 implements SequenceInterface
    {

        public function handle(Request $request)
        {
            $response = new Response();
            $items = ['food','drink','airtime'];

            if (isset($items[$request->getMessage()])) {
                $response->setmessage("Are you sure you want free {$items[$request->getMessage()]}?\n1. Yes\n2. No");
                $response->setType(RequestTypes::RESPONSE);
                $response->setClientState($items[$request->getMessage()]);
            } else {
                $response->setMessage('Invalid option.');
                $response->setType(RequestTypes::RELEASE);
            }
            return $response;
        }
    }

    Sequence3.php
    <?php
    namespace App\Sequences;


    use Hubtel\USSD\Request;
    use Hubtel\USSD\RequestTypes;
    use Hubtel\USSD\Response;
    use Hubtel\USSD\SequenceInterface;

    class Sequence3 implements SequenceInterface
    {

        public function handle(Request $request)
        {
            $response = new Response();
            switch ($request->getMessage()) {
                case 1:
                    $response->setMessage("Thank you. You will receive your free {$request->getClientState()} shortly.");
                    break;
                case 2:
                    $response->setMessage("Order cancelled.");
                    break;
                default:
                    $response->setMessage("Invalid selection.");
                    break;
            }
            $response->setType(RequestTypes::RELEASE);
            return $response;
        }
    }
```