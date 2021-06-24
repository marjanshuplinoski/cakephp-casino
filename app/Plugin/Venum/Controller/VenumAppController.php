<?php

App::uses('AppController', 'Controller');

class VenumAppController extends AppController
{
	/**
	 * Controller name
	 * @var $name string
	 */
	public $name = 'Venum';

	/**
	 * Paginate
	 * @var array
	 */
	public $paginate = array();

	/**
	 * Models
	 * @var array
	 */
	public $uses = array('Venum.Venum');

	public $components = array('Auth');

	/**
	 * Called before the controller action.
	 */
	public function beforeFilter()
	{
		$this->autoRender = false;
		$this->layout = 'ajax';
		$this->Auth->allow('getPlayerID', 'casino_create_player_if_not_exists', 'casino_player_exists', 'player_request_token', 'casino_request_demo_token', 'player_check_wallet', 'player_trigger_cancel', 'casino_get_balance',
			'casino_block_player', 'casino_unblock_player', 'casino_list_games', 'player_pending_games', 'casino_clear_old_game_sessions', 'ping', 'casino_create_bank_if_not_exists', 'casino_set_bank_for_player', 'casino_unset_bank_for_player',
			'casino_set_jackpot_group_for_bank', 'casino_unset_jackpot_group_for_bank', 'player_get_bank', 'casino_list_banks', 'casino_get_payout_stats', 'casino_get_payout_stats_per_game', 'casino_jackpot_info', 'casino_browse_jackpot_history',
			'casino_create_jackpot_group_if_not_exists', 'casino_disable_jackpots', 'casino_enable_jackpots', 'casino_egt_jackpot_info', 'getPlayerBalance', 'withdrawAndDeposit', 'cancel');
		parent::beforeFilter();
	}

	public function getPlayerID()
	{
		//test data

		$response = $this->Venum->getPlayerID();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_create_player_if_not_exists()
	{
		//test data
		$query = array(
			'playerid' => 'someID',                // maximum of 14 characters!
			'bankid' => 'somebank'                //The bank needs to be created before the player is created.
		);
		$response = $this->Venum->casino_create_player_if_not_exists($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_player_exists()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);
		$response = $this->Venum->casino_player_exists($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function player_request_token()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);
		$response = $this->Venum->player_request_token($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_request_demo_token()
	{
		//test data

		$response = $this->Venum->casino_request_demo_token();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function player_check_wallet()
	{

		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);

		$response = $this->Venum->player_check_wallet($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function player_trigger_cancel()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);

		$response = $this->Venum->player_trigger_cancel($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_get_balance()
	{
		$response = $this->Venum->casino_get_balance();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_block_player()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);

		$response = $this->Venum->casino_block_player($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_unblock_player()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);

		$response = $this->Venum->casino_unblock_player($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_list_games()
	{
		//test data
		$query = array(
			'filter_brands' => 'IGT',                    // „Novomatic”, IGT”, „Playtech”, „Amatic”,„Microgaming”, „EGT”, „EGT Jackpot”, „Wazdan” and „Netent”
			'filter_channel' => 'desktop',                // „desktop” and „mobile”
			'filter_technology' => 'flash',                // "flash" "html5"
			'filter_categories' => 'VideoSlots',            //„VideoSlots” and „TableGames”
			'filter_lines' => 1,                            // The value can be also a comma-delimited list of multiple integers representing multiple numbers of paylines.
			'order_by' => 'name',                            //„name”, „brand”, „category” or „lines”
			'order' => 'asc',                                // "asc" or "desc"
		);

		$response = $this->Venum->casino_list_games($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function player_pending_games()
	{
		//test data
		$query = array(
			'playerid' => 'someID'                // maximum of 14 characters!
		);

		$response = $this->Venum->player_pending_games($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_clear_old_game_sessions()
	{
		//test data
		$query = array(
			'days' => 15
		);

		$response = $this->Venum->casino_clear_old_game_sessions($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function ping()
	{
		$response = $this->Venum->ping();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_create_bank_if_not_exists()
	{
		//test data
		$query = array(
			'bankid' => 'somebank',                            // maximum of 14 characters!
			'jackpotgroupid' => 12312
		);

		$response = $this->Venum->casino_create_bank_if_not_exists($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_set_bank_for_player()
	{
		//test data
		$query = array(
			'bankid' => 'somebank',                            // maximum of 14 characters!
			'playerid' => 12312
		);

		$response = $this->Venum->casino_set_bank_for_player($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_unset_bank_for_player()
	{
		//test data
		$query = array(
			'playerid' => 12312
		);

		$response = $this->Venum->casino_unset_bank_for_player($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_set_jackpot_group_for_bank()
	{
		//test data
		$query = array(
			'jackpotgroupid' => 12312,
			'bankid' => 'somebank'                            // maximum of 14 characters!
		);

		$response = $this->Venum->casino_set_jackpot_group_for_bank($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_unset_jackpot_group_for_bank()
	{
		//test data
		$query = array(
			'bankid' => 'somebank'                            // maximum of 14 characters!
		);

		$response = $this->Venum->casino_unset_jackpot_group_for_bank($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function player_get_bank()
	{
		//test data
		$query = array(
			'playerid' => 'somebank'                            // maximum of 14 characters!
		);
		$response = $this->Venum->player_get_bank($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_list_banks()
	{
		$response = $this->Venum->casino_list_banks();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function casino_get_payout_stats()
	{
		//test data
		$query = array(
			'filter_time_from' => time(),
			'filter_time_to' => time(),
			'filter_playerids' => 'SomePlayerID',
			'filter_games' => 'alwayshotcubes',                //The value must be a game name (for example: „alwayshotcubes”), or a list of game names separated by comma (,).
			'include_jackpot_wins' => 0
		);
		$response = $this->Venum->casino_get_payout_stats($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_get_individual_payout_stats()
	{
		//test data
		$query = array(
			'order_by' => 'player',                            //„player”, „play_count”, „total_in”, „total_out”, „rtp_percentage”.
			'order' => 'asc',                                    // asc or desc
			'limit' => 10
		);
		$response = $this->Venum->casino_get_individual_payout_stats($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_get_payout_stats_per_game()
	{
		//test data
		$query = array(
			'order_by' => 'player',                            //„player”, „play_count”, „total_in”, „total_out”, „rtp_percentage”.
			'order' => 'asc',                                    // asc or desc
			'limit' => 10
		);
		$response = $this->Venum->casino_get_payout_stats_per_game($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_jackpot_info()
	{
		$response = $this->Venum->casino_jackpot_info();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_browse_jackpot_history()
	{
		//test data
		$query = array(
			'filter_time_from' => time(),                            //„player”, „play_count”, „total_in”, „total_out”, „rtp_percentage”.
			'filter_time_to' => time(),                              // asc or desc
			'filter_playerids' => 'playerID',
			'filter_level' => 1,                                        //1,2,3,4
			'order_by' => 'player',                            //„player”, „play_count”, „total_in”, „total_out”, „rtp_percentage”.
			'order' => 'asc',                                    // asc or desc
			'records_per_page' => 1,                                // 1 to 100
			'page' => 1
		);

		$response = $this->Venum->casino_browse_jackpot_history($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_create_jackpot_group_if_not_exists()
	{
		//test data
		$query = array(
			'jackpotgroupid' => 'id'                                    //maximum of 14 characters
		);

		$response = $this->Venum->casino_create_jackpot_group_if_not_exists($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_disable_jackpots()
	{
		//test data
		$query = array(
			'jackpotgroupid' => 'id'                                    //maximum of 14 characters
		);

		$response = $this->Venum->casino_disable_jackpots($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function casino_enable_jackpots()
	{
		//test data
		$query = array(
			'jackpotgroupid' => 'id'                                    //maximum of 14 characters
		);

		$response = $this->Venum->casino_enable_jackpots($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


	public function casino_egt_jackpot_info()
	{
		$response = $this->Venum->casino_egt_jackpot_info();
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function getPlayerBalance()
	{
		//test data
		$query = array(
			'OperatorId' => 'id',
			'UserId' => 'playerid',
			'GameId' => 'someGameID',                //lower case alphanumeric name
			'GameBrand' => 'brand',                //lower case alphanumeric name
			'SessionId' => 'gameSessionID',
			'Reason' => 'GameInitialization'            //Reason of the request: typically ’GameInitialization’ or ’CheckingForDeposit’, however, it should be noted that a GetPlayerBalance request might be made in place of a WithdrawAndDeposit call as well, in cases when both the deposit and withdrawal amounts equal to zero, typically in a losing free spin of slots – in this case the reason is ’SlotSpin’. Netent games also request GetPlayerBalance with reason ’BalanceCheck’ – this typically happens at any game event as an initial check, and might be followed by a WithdrawAndDeposit request.

		);
		$response = $this->Venum->getPlayerBalance($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function withdrawAndDeposit()
	{
		//test data
		$query = array(
			'OperatorId' => 'id',
			'UserId' => 'playerid',
			'GameId' => 'someGameID',                //lower case alphanumeric name
			'GameBrand' => 'brand',                //lower case alphanumeric name
			'SessionId' => 'gameSessionID',
			'BetId' => 'someBetID',
			'TransactionId' => 'walletIDTransaction',
			'Reason' => 'GameInitialization',            // ’SlotSpin’, ’SlotGamble’,’Collect’, ’CollectHalf’, ’JackpotWin’, ’RouletteSpin’.
			'WithdrawAmount' => 150,
			'DepositAmount' => 150
		);
		$response = $this->Venum->withdrawAndDeposit($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}

	public function cancel()
	{
		//test data
		$query = array(
			'OperatorId' => 'id',
			'UserId' => 'playerid',
			'TransactionId' => 'walletIDTransaction'
		);
		$response = $this->Venum->cancel($query);
		$response = json_decode(json_encode($response), true);
		$this->response->body(json_encode(array('response' => $response)));
		return $response;
	}


}

