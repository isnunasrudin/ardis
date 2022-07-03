<?php

namespace Libraries;

class Validation
{
    use ValidationRules;

    private $firstError = null;
    private $errors = array();

    public function __construct(
        protected Request $request,
        protected array $rules,
        protected array $aliases = array(),
    ){}

    public function run() : bool
    {
        foreach($this->rules as $input => $rules) foreach($rules as $rule)
        {
            $rule = preg_split("/^(\w):(.*)?/", $rule);
            if(isset($rule[1])) $params = explode(',', $rule[1]);
            
            $result = $this->runRule(
                $rule[0],
                $this->aliases[$input] ?? $input,
                $this->request->any($input),
                ...$params ?? []
            );
            if($result !== TRUE)
            {
                if($this->firstError === null) $this->firstError = $result;
                $this->errors[] = $result;
            } 
        }

        if(count($this->errors) > 0) return false;
        return true;
    }

    private function runRule($rule, ...$params) : string|bool
    {
        return call_user_func_array([$this, "rule_$rule"], $params);
    }

    public function getMessage() : string|null
    {
        return $this->firstError;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }
}