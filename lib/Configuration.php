<?php
/**
 * Copyright (C) 2016 Derek J. Lambert
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace CrEOF\Geo\Obj;

use CrEOF\Geo\Obj\Traits\Singleton;
use CrEOF\Geo\Obj\Exception\UnexpectedValueException;
use CrEOF\Geo\Obj\Validator\ValidatorInterface;
use CrEOF\Geo\Obj\Validator\TypeValidator;

/**
 * Class Configuration
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
final class Configuration
{
    use Singleton;

    /**
     * @var ValidatorInterface[]
     */
    private $validators;

    protected function __construct()
    {
        $this->validators = [];
        $validator        = new TypeValidator();

        $validator->setType('CrEOF\Geo\Obj\Point');
        $this->setValidator('CrEOF\Geo\Obj\Point', $validator);
    }

    /**
     * @param string             $type
     * @param ValidatorInterface $validator
     *
     * @throws UnexpectedValueException
     */
    public function setValidator($type, ValidatorInterface $validator)
    {
        $this->validators[ObjectFactory::getTypeClass($type)] = $validator;
    }

    /**
     * @param string $type
     *
     * @return ValidatorInterface
     *
     * @throws UnexpectedValueException
     */
    public function getValidator($type)
    {
        $typeClass = ObjectFactory::getTypeClass($type);

        return isset($this->validators[$typeClass]) ?  $this->validators[$typeClass] : null;
    }
}
