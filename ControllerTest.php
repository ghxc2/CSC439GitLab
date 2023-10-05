<?php
require_once 'Main.php';

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    private $model;
    private $view;
    private $sut;
    
    public function setUp() :void {
        $d = new YahtzeeDice();
        $this->model = new Yahtzee($d);
        $this->view = $this->createStub(YahtzeeView::class);
        $this->sut = new YahtzeeController($this->model, $this->view);
    }
    /**
    * @covers \YahtzeeController::get_model
    */
    public function test_get_model(){
        $result = $this->sut->get_model();
        $this->assertNotNull($result);
    }
    /**
    * @covers::get_view
    */
    public function test_get_view(){
        $result = $this->sut->get_view();
        $this->assertNotNull($result);
    }
    /**
    * @covers \YahtzeeController::get_possible_categories
    */
    public function test_get_possible_categories(){
        $result = $this->sut->get_possible_categories();
        $this->assertNotNull($result);
    }
    /**
    * @covers \YahtzeeController::process_keep_input
    */
    public function test_process_keep_input_exit(){
        $result = $this->sut->process_keep_input("exit");
        $this->assertEquals(-1, $result);
        
        $result = $this->sut->process_keep_input("q");
        $this->assertEquals(-1, $result);
    }
    /**
    * @covers \YahtzeeController::process_keep_input
    */
    public function test_process_keep_input_all(){
        $result = $this->sut->process_keep_input("all");
        $this->assertEquals(0, $result);
    }
    /**
    * @covers \YahtzeeController::process_keep_input
    */
    public function test_process_keep_input_certain(){
        $this->model->roll(6);
        $result = $this->sut->process_keep_input(1);
        $this->assertNotEquals(-2, $result);
        
        $result = $this->sut->process_keep_input(2);
        $this->assertNotEquals(-2, $result);
    }
    /**
    * @covers \YahtzeeController::process_keep_input
    */
    public function test_process_keep_input_certain_fail(){
        $this->model->roll(6);
        $result = $this->sut->process_keep_input("12");
        $this->assertEquals(-2, $result);
    }
}

?>