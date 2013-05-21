<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Game\Controller;
use Zend\Session\SessionManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Game\Model\Game;
use Game\Model\GameTable;
use Game\Form\GameForm;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Message;
use Zend\Mail;
use Zend\Session\Container;

class GameController extends AbstractActionController
{
	protected $gameTable;
	
	public function getGameTable()
	{
		if (!$this->gameTable) {
			$sm = $this->getServiceLocator();
			$this->gameTable = $sm->get('Game\Model\GameTable');
		}
		return $this->gameTable;
	}
	
    public function revengeAction(){
    	$hash =  $this->params()->fromRoute('hash', 0);
    	if($hash==!0){
	    	$gametmp=$this->getGameTable()->getGameHash($hash);
	    	$form = new GameForm();
	    	$form->get('user1')->setValue($game->user1=$gametmp->user2);
	    	$form->get('user2')->setValue($game->user1=$gametmp->user1);
	    	$form->get('email1')->setValue($game->user1=$gametmp->email2);
	    	$form->get('email2')->setValue($game->user1=$gametmp->email1);
	    	$form->get('submit')->setValue('New Game');
	    	$request = $this->getRequest();
	    	if ($request->isPost()) {
	    		$game= new Game();
	    		$form->setInputFilter($game->getInputFilter());
	    		$form->setData($request->getPost());
	    		 
	    		if ($form->isValid()) {
	    			$game->exchangeArray($form->getData());
	    			$this->getGameTable()->saveGame($game);
	    			$transport = new SmtpTransport();
	    			$this->transport = new SmtpTransport();
	    			$options   = new SmtpOptions(array(
	    					'host' => 'smtp.uibk.ac.at',
	    					'name' => 'smtp.uibk.ac.at',
	    					'port' => 587,
	    			));
	    			$link= 'to fight click http://138.232.66.90'.$this->url()->fromRoute('game',array('action' => 'fight','hash'=>$game->hash));
	    			$transport->setOptions($options);
	    			$message = new Message();
	    			$message->addTo($game->email2)
	    			->addFrom('Aaron.Messner@student.uibk.ac.at')
	    			->setSubject('ready to fight?')
	    			->setBody($link);
	    			$transport->send($message);
	    			return $this->redirect()->toRoute('game');
	    		}
	    	}
	    	return new ViewModel(array('game'=>$gametmp,'form'=>$form));
    	}else{
    		return $this->redirect()->toRoute('game', array('action' => 'fight','hash'=>$game->hash));
    	}
    }


    public function indexAction()
    {
    
    	$form = new GameForm();
    	//$form->bind($game);
    	//$form->get('submit')->setAttrib('onclick', 'my_alert()');
    	$manager = new SessionManager();
    	Container::setDefaultManager($manager);
    	$session = new Container('base');
    	if($session->offsetExists('email')&& $session->offsetExists('user')){
    		$form->get('user1')->setValue($session->offsetGet('user'));
    		$form->get('email1')->setValue($session->offsetGet('email'));
    	}
    	$form->get('choice1')->setValue(1);
    	$form->get('submit')->setValue('New Game');
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$game= new Game();
    		$form->setInputFilter($game->getInputFilter());
    		$form->setData($request->getPost());
    		 
    		if ($form->isValid()) {
    			$game->exchangeArray($form->getData());
    			$this->getGameTable()->saveGame($game);
    			
    			$session->offsetSet('email', $game->email1);
    			$session->offsetSet('user', $game->user1);
			$transport = new SmtpTransport();
			$this->transport = new SmtpTransport();
			$options   = new SmtpOptions(array(
			'host' => 'smtp.uibk.ac.at',
			'name' => 'smtp.uibk.ac.at',
			 'port' => 587,
			 ));
			$link= 'to fight click http://138.232.66.90'.$this->url()->fromRoute('game',array('action' => 'fight','hash'=>$game->hash)); 
			$transport->setOptions($options);
			$message = new Message();
			$message->addTo($game->email2)
			        ->addFrom('Aaron.Messner@student.uibk.ac.at')
			        ->setSubject('ready to fight?')
			        ->setBody($link);
			$transport->send($message);
    			//return $this->redirect()->toRoute('game', array('action' => 'fight','hash'=>$game->hash));
    		}
    	}
    	//witerleiten zum 'kampf'
    	//return $this->redirect()->toRoute('game', array('action' => 'fight','hash'=>'sdgfsdfghdfs'));
    	return new ViewModel(array('form'=>$form));
    }

    public function allAction()
    {
    	return new ViewModel(array('games'=>$this->getGameTable()->fetchAll()));
    }

    public function fightAction()
    {	
    	
    	$hash =  $this->params()->fromRoute('hash', 0);
    	if($hash==!0){
    		$gametmp=$this->getGameTable()->getGameHash($hash);
    		if($gametmp->choice2==!0){
    			return $this->redirect()->toRoute('game',array("action"=>'result','hash'=>$gametmp->hash));
    		}
    		$form = new GameForm();
    		$form->get('choice2')->setValue(1);
    		$request = $this->getRequest();
    		if ($request->isPost()) {
    			$game= new Game();
    			$form->setInputFilter($game->getInputFilter2());
    			$form->setData($request->getPost());
    			if ($form->isValid() ) {
    				$game->exchangeArray($form->getData());
    				$game->user1=$gametmp->user1;
    				$game->email1=$gametmp->email1;
    				$game->choice1=$gametmp->choice1;
    				$game->user2=$gametmp->user2;
    				$game->email2=$gametmp->email2;
    				$game->hash=$gametmp->hash;
    				$this->getGameTable()->saveGame($game);
    				return $this->redirect()->toRoute('game',array("action"=>'result','hash'=>$gametmp->hash));
    			}
    		}else{
    			$form->bind($gametmp);
    		}
    		//return $this->redirect()->toRoute('game');
    		return new ViewModel(array('hallo'=>$this->getGameTable()->getGameHash($hash),'form'=>$form));
    	}else{
    		return $this->redirect()->toRoute('game');
    	}
    	
    }

    public function resultAction()
    {
    	$hash =  $this->params()->fromRoute('hash', 0);
    	if($hash==!0){
    		$game=$this->getGameTable()->getGameHash($hash);
			$var1 = ($game->choice1 - 1 < 0) ? 4 : $game->choice1 - 1;
			$var2 = ($game->choice2 - 1 < 0) ? 4 : $game->choice2 - 1;
			if($game->choice1 === $game->choice2){
				$game->result = "The game ended in a draw.";	
			}elseif($var2 === ($var1 + 2) % 5 || $var2 === ($var1 + 4) % 5){
				$game->result = $game->user1." has won the game.";
			}else{
				$game->result = $game->user2." has won the game.";	 
			}
    		return new ViewModel(array('game'=>$game));
    	}else{
    		return $this->redirect()->toRoute('game');
    	}
    
    }
    
    

}
