# Hubtel USSD

Based on [Hubtel's USSD API](https://developers.hubtel.com/documentations/ussd)

## About

This package helps you to build maintainable and scalable USSD applications by breaking down your "long switch" statement USSD application into modules

## Getting Started

Check out [this link](https://developers.hubtel.com/documentations/ussd#how-to-get-ussd-short-code) to know how you can acquire a USSD code from Hubtel.

### Installing

Install the package from `composer`

```
composer require norris1z/hubtel-ussd
```

### Usage

Setup a `route` to respond to all `Hubtel's` requests. 

Note that `Hubtel` sends no `csrf` tokens hence disable `csrf`protection for that `route`.

For `Laravel`, add the `route` to the `except` array in the `VerifyCsrfToken` middleware.

`Hubtel\USSD\Request::class` is a class which represents the request from `Hubtel`. It has methods for all the parameters listed on `Hubtel's Documentation Page`.

View Source [Request.php](https://github.com/Norris1z/hubtel-ussd-php/blob/master/src/Hubtel/Request.php)

`Hubtel\USSD\Response::class` is a class which represents the response sent to `Hubtel`. It has methods for all the parameters listed on `Hubtel's Documentation Page`.

View Source [Response.php](https://github.com/Norris1z/hubtel-ussd-php/blob/master/src/Hubtel/Response.php)
 
`RequestTypes::class` has two properties, `RESPONSE` and `RELEASE` for indicating the type of response in a sequence.

```php
    $response = Response::createInstance('Hello Hubtel, i want a response',RequestTypes::RESPONSE);
    $response = Response::createInstance('Hello Hubtel, end the sequence',RequestTypes::RELEASE);
```

`USSD::class` is a class with one static method `process` which takes two parameters a `Request (an instance of Hubtel\USSD\Reqeust)` and
an `array` of `sequence (any class that implements the Hubtel\USSD\SequenceInterface)`;

```php
     USSD::process(/** An instance of Hubtel\USSD\Request **/,[
        new Sequence1(),
        new Sequence2(),
        new Sequence3()
    ])->toArray();
```

All `seqeunces` must have implement the `SequenceInterface` and hence have a `handle` method and must return an instance of `Hubtel\USSD\Response (Response)`.
The `USSD::process` method automagically injects a `Request` parameter into the `handle` method of each `sequence`. This `Request` is an 
instace of `Hubtel\USSD\Request` which grants access to all properties and methods in the `request`.

```php
    //Sequence1.php
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
```

Visit [Hubtel's USSD Api documentation page](https://developers.hubtel.com/documentations/ussd-api) for the list of methods on the request 
and response classes

## Examples
1. [Laravel](https://github.com/Norris1z/hubtel-ussd-php/blob/master/examples/Laravel.md)
2. [Lumen](https://github.com/Norris1z/hubtel-ussd-php/blob/master/examples/Lumen.md)


Feel free to submit pull-requests for examples with other frameworks :blush:


## Running the tests

`composer test`

## Authors

* **Norris Oduro** - [Norris1z](https://github.com/Norris1z)

## License

This project is licensed under the MIT License
