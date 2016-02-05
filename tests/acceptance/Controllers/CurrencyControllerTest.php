<?php
/**
 * CurrencyControllerTest.php
 * Copyright (C) 2016 Sander Dorigo
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-19 at 15:39:28.
 */
class CurrencyControllerTest extends TestCase
{

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::create
     * @covers FireflyIII\Http\Controllers\CurrencyController::__construct
     */
    public function testCreate()
    {
        $this->be($this->user());
        $this->call('GET', '/currency/create');
        $this->assertResponseStatus(200);
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::defaultCurrency
     */
    public function testDefaultCurrency()
    {
        $this->be($this->user());
        $this->call('GET', '/currency/default/2');
        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('currency.index');
        $this->assertSessionHas('success');
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::delete
     */
    public function testDelete()
    {
        $this->be($this->user());
        $this->call('GET', '/currency/delete/2');
        $this->assertResponseStatus(200);
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::destroy
     */
    public function testDestroy()
    {
        $this->session(['currency.delete.url' => 'http://localhost/currency']);
        $this->be($this->user());
        $this->call('POST', '/currency/destroy/3');
        $this->assertSessionHas('success');
        $this->assertRedirectedToRoute('currency.index');
        $this->assertResponseStatus(302);
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::edit
     */
    public function testEdit()
    {
        $this->be($this->user());
        $this->call('GET', '/currency/edit/2');
        $this->assertResponseStatus(200);

    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::index
     * @dataProvider dateRangeProvider
     */
    public function testIndex($range)
    {
        $this->be($this->user());
        $this->call('GET', '/currency');
        $this->assertResponseStatus(200);
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::store
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::authorize
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::rules
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::getCurrencyData
     */
    public function testStore()
    {
        $this->be($this->user());
        $this->session(['currency.create.url' => 'http://localhost/currency']);
        $args = [
            'name'   => 'New Euro.',
            'symbol' => 'Y',
            'code'   => 'IUY',
        ];

        $this->call('POST', '/currency/store', $args);
        $this->assertResponseStatus(302);
        $this->assertSessionHas('success');
        $this->assertRedirectedToRoute('currency.index');
    }

    /**
     * @covers FireflyIII\Http\Controllers\CurrencyController::update
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::authorize
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::rules
     * @covers FireflyIII\Http\Requests\CurrencyFormRequest::getCurrencyData
     */
    public function testUpdate()
    {
        $this->session(['currency.edit.url' => 'http://localhost/currency']);

        $args = [
            'id'     => 1,
            'name'   => 'New Euro.',
            'symbol' => 'Y',
            'code'   => 'IUY',
        ];
        $this->be($this->user());

        $this->call('POST', '/currency/update/1', $args);
        $this->assertResponseStatus(302);
        $this->assertSessionHas('success');
        $this->assertRedirectedToRoute('currency.index');

    }
}
