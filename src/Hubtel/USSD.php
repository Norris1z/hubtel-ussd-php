<?php

namespace Hubtel\USSD;

class USSD
{
    public static function process(Request $request, array $sequences)
    {
        if (sizeof($sequences) === 0) {
            throw new \InvalidArgumentException("Sequences must not be an empty array");
        }
        
        if(!is_numeric($request->getSequence()) || !isset($sequences[(int)$request->getSequence() - 1])) {
            return Response::createInstance("Sorry!. Something went wrong",RequestTypes::RELEASE);
        }

        $sequence = $request->getSequence() - 1;

        if (! $sequences[$sequence] instanceof SequenceInterface) {
            throw new \UnexpectedValueException("All Sequences must implement the SequenceInterface");
        }

        $response = $sequences[$sequence]->handle($request);

        if (! $response instanceof Response) {
            throw new \UnexpectedValueException("Sequences must return an instance of Hubtel\\USSD\\Response");
        }

        return $response;
    }
}
