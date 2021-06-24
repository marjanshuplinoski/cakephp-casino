<?php

App::uses('AppModel', 'Model');

class VenumAppModel extends AppModel
{

	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);
		Configure::load('Venum.Venum');

		if (Configure::read('Venum.Config') == 0)
			throw new Exception('Config not found', 500);

		$this->config = Configure::read('Venum.Config');
	}

	/*r
	 * Get Player ID
	 * This function is supposed to return the identifier that you wish to use in API calls in
	 * order to identify your current logged in user.
	 *
	 * gameplay.php
	 */

	public function getPlayerID()
	{
		$endpoint = 'api/v1/withdrawals';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}


	/*
	 * Create Player if Not exists
	 * This creates an account for your user which enables them to play games in real money mode.
	 */

	public function casino_create_player_if_not_exists($query)
	{
		$endpoint = 'casino/create_player_if_not_exists';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Check if Player exists
	 * This checks whether or not you have already registered a specific player identifier in our system.
	 */

	public function casino_player_exists($query)
	{
		$endpoint = 'casino/player_exists';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Request token
	 * This request assigns a one-time unique alphanumeric identifier to your user, which being
	 * passed to the game (check ExternalInterface configuration section for further details)
	 * enables gameplay without any callbacks from flash game to your server.
	 */

	public function player_request_token($query)
	{
		$endpoint = 'player/request_token';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Request Demo Token
	 * You can use this method instead of player/request_token to obtain a token that enables
	 * gameplay ONLY in PLAY FOR FUN mode, in case player is not logged in on your system or you
	 * prefer to avoid sending a player id for some reason.
	 */

	public function casino_request_demo_token()
	{
		$endpoint = 'casino/request_demo_token';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}

	/*
	 *  Check player wallet
	 *  By this request you instruct an open game session to communicate to your Wallet API even if
	 *  the game is in idle state at the moment (normally the wallet balance is checked only on
	 *  game initialization and betting rounds).
	 */

	public function player_check_wallet($query)
	{
		$endpoint = 'player/check_wallet';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Player trigger cancel
	 * This method checks whether there is a pending cancellation of a previous wallet transaction
	 * request initiated by the specified player’s account, and if there is one, the Cancel request is
	 * repeated once towards your Wallet API.
	 */

	public function player_trigger_cancel($query)
	{
		$endpoint = 'player/trigger_cancel';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Casino get balance
	 * Use this endpoint to get your actual casino balance.
	 */

	public function casino_get_balance()
	{
		$endpoint = 'casino/get_balance';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}

	/*
 	 * Casino block player
	 * Use this method to block a player. Blocking disables this player to play any games in real
	 * money mode.
 	 */

	public function casino_block_player($query)
	{
		$endpoint = 'casino/block_player';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
 	 * Casino unblock player
	 * Use this method to unblock a previously blocked player.
 	 */

	public function casino_unblock_player($query)
	{
		$endpoint = 'casino/unblock_player';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Casino list games
	 * This method provides a list of available games for your account, with basic details: identifier,
	 * name, brand, category, technology (Flash or Html5), channel (desktop and/or mobile),
	 * number of paylines (slots), features, description and URL to the game’s logo image.
	 */

	public function casino_list_games($query)
	{
		$endpoint = 'casino/list_games';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * pending games
	 * This endpoint lists all currently open (incomplete) game rounds of a player, including the
	 * game id, round id and the timestamp of last activity.
	 */

	public function player_pending_games($query)
	{
		$endpoint = 'player/pending_games';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Clear old game sessions
	 * This method deletes all game sessions older than a specified number of days (by default 30).
	 */

	public function casino_clear_old_game_sessions($query)
	{
		$endpoint = 'casino/clear_old_game_sessions';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * ping
	 * Use endpoint ’ping’ to check whether the API service is available at the moment.
	 */

	public function ping()
	{
		$endpoint = 'ping';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}

	/*
	 * create bank if not exists
	 * This creates a separate set of payout configurations (bank) to which you can assign a group
	 * of player accounts (otherwise all players share the same settings and pools).
	 */

	public function casino_create_bank_if_not_exists($query)
	{
		$endpoint = 'casino/create_bank_if_not_exists';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * set bank for player
	 * This method assigns an existing player to a bank.
	 */

	public function casino_set_bank_for_player($query)
	{
		$endpoint = 'casino/set_bank_for_player';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * 	unset bank for player
	 * If the specified player is assigned to a bank, this method removes the player from the bank.
	 * The player is then assigned to the default payout settings and pools of your account.
	 */

	public function casino_unset_bank_for_player($query)
	{
		$endpoint = 'casino/unset_bank_for_player';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * set jackpot group for bank
	 * This method assigns an existing bank to a jackpot group.
	 */

	public function casino_set_jackpot_group_for_bank($query)
	{
		$endpoint = 'casino/set_jackpot_group_for_bank';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * unset jackpot group for bank
	 * If the specified bank is assigned to a jackpot group, this method removes the bank from the
	 * jackpot group. The bank is then assigned to the default jackpot settings and pools of your
	 * account.
	 */

	public function casino_unset_jackpot_group_for_bank($query)
	{
		$endpoint = 'casino/unset_jackpot_group_for_bank';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}


	/*
	 * get player bank
	 * Use this endpoint to check which bank your player is assigned to.
	 */

	public function player_get_bank($query)
	{
		$endpoint = 'player/get_bank';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * List banks
	 * Use this endpoint to get a list of all your banks and to check which jackpot group each is assigned to.
	 */
	public function casino_list_banks()
	{
		$endpoint = 'casino/list_banks';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}

	/*
	 * API calls for game reports:
	 *
	 * Get Payout stats
	 * This method returns the total amounts of payin and payout, the number of games played
	 * (how many times your players bet) based on game history, and the value of return to player
	 * in percentage.
	 */

	public function casino_get_payout_stats($query)
	{
		$endpoint = 'casino/get_payout_stats';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * Get individual payouts stats
	 * An alternative method to get_payout_stats, with the same functionality and the same optional parameters.
	 */

	public function casino_get_individual_payout_stats($query)
	{
		$endpoint = 'casino/get_individual_payout_stats';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}


	/*
	 * get payout stats per game
	 * An alternative method to get_payout_stats, with the same functionality and the same optional parameters.
	 */

	public function casino_get_payout_stats_per_game($query)
	{
		$endpoint = 'casino/get_payout_stats_per_game';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}


	/*
	 * API calls related to Jackpots:
	 *
	 *  Jackpot info
	 * This method returns the parameters of each of the 4 jackpots (amount to win, rate,
	 * minimum charge, activating charge) and the current amounts of charge and price.
	 */

	public function casino_jackpot_info($query)
	{
		$endpoint = 'casino/jackpot_info';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * browse jackpot history
	 * This method enables you to get data out of the jackpot log of the API, and returns some
	 * information on jackpots which have already been paid out (time of the win, identifier of the
	 * player who won the jackpot, the level of jackpot (low – 1, medium – 2, high – 3, huge – 4),
	 * the amount won and the amount of charge at the moment when the jackpot was paid out).
	 */

	public function casino_browse_jackpot_history($query)
	{
		$endpoint = 'casino/browse_jackpot_history';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}


	/*
	 * create jackpot group if not exists
	 * This creates a separate set of jackpot configurations and pools to which you can assign a
	 * group of banks (otherwise all banks share the same jackpot pools). Creation of jackpot
	 * groups and linkage with banks is your responsibility.
	 */

	public function casino_create_jackpot_group_if_not_exists($query)
	{
		$endpoint = 'casino/create_jackpot_group_if_not_exists';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * disable jackpots
	 * This method disables all available jackpots in a jackpot group.
	 */

	public function casino_disable_jackpots($query)
	{
		$endpoint = 'casino/disable_jackpots';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * enable jackpots
	 * This method enables all available jackpots in a jackpot group.
	 */

	public function casino_enable_jackpots($query)
	{
		$endpoint = 'casino/enable_jackpots';
		$request = $this->apirequest($endpoint, $query);
		return $request;
	}

	/*
	 * EGT jackpot info
	 * Only available for EGT Jackpot games, Jackpot Cards Mystery is a randomly triggered bonus.
	 * Jackpot Cards is a four-level mystery jackpot. Each mystery jackpot level is illustrated by a
	 * card suit:
	 */

	public function casino_egt_jackpot_info()
	{
		$endpoint = 'casino/egt_jackpot_info';
		$request = $this->apirequest($endpoint, array());
		return $request;
	}

	/*
	 *
	 */



	public function apirequest($ENDPOINT, $PARAMS = array())
	{

		$PARAMS["pubkey"] = $this->config['Config']['API_KEY'];
		$PARAMS["time"] = time();
		$PARAMS["nonce"] = md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10) . microtime());
		$PARAMS["requrl"] = rtrim($this->config['Config']['API_URL'], "/") . "/" . ltrim($ENDPOINT, "/");
		$PARAMS["hmac"] = base64_encode(hash_hmac("sha1", http_build_query($PARAMS) . "ILN4kJYDx8", $this->config['Config']['API_SECRET_KEY'], true));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $PARAMS["requrl"]);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Accept: application/json"));
		curl_setopt($ch, CURLOPT_USERAGENT, "cURL post");
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($PARAMS));
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		$result = curl_exec($ch);
		if (curl_errno($ch)) $result = json_encode(array("status" => "cURL Error: " . curl_error($ch)));
		else if (curl_getinfo($ch, CURLINFO_CONTENT_TYPE) !== "application/json") $result = json_encode(array("status" => "Error: Unexpected response content type."));
		else if (json_decode($result, true) == NULL) $result = json_encode(array("status" => "Error: Invalid json object received."));
		else {
			$responsearray = json_decode($result, true);
			if (!isset($responsearray["status"])) $result = json_encode(array("status" => "Error: Response status unknown."));
			else if ($responsearray["status"] !== "OK") $result = json_encode(array("status" => $responsearray["status"]));
			else if (!isset($responsearray["hmac"])) $result = json_encode(array("status" => "Error: Response HMAC not received."));
			else {
				$responsehmac = $responsearray["hmac"];
				unset($responsearray["hmac"]);
				$regeneratedhmac = base64_encode(hash_hmac("sha1", http_build_query($PARAMS) . "tnPEKn7ff1" . json_encode($responsearray), $secretkey, true));
				if ($regeneratedhmac !== $responsehmac) $result = json_encode(array("status" => "Error: Response HMAC mismatch."));
				else $result = json_encode($responsearray);
			}
		}

		return $result;
	}
}

