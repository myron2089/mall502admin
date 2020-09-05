<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use App;
use Session;
use Arr;


class HttpHelper{
	

	private $base_uri;
	


	public function __construct()
	{
		//$this->guzzle = new Client(['base_uri' => 'apimall.nuntechnologies.com/public/', 'http_errors' => false]);
		
		//$this->un = getenv("API_USERNAME");
		//$this->pw = getenv("API_PASSWORD");
		$this->base_uri = 'http://wsmall502.nuntechnologies.com/api/';
	}


	/*
	*
	* type: get, post
	* from: public, auth
	* endpoint
	* dat: array
	*
	*
	*/
	public function request($type, $from, $endpoint, $data ){


		//dd($data);
		$headers = ['Content-Type' => 'application/json; charset=UTF8',
				  'timeout' => 10,
			      ];


	    if($from == 'auth'){

	    	$headers = Arr::add($headers, 'Authorization' , 'Bearer '. Session::get('userInfo')->data->access_token);

	    	

	    }


			switch ($type) {
				case 'get':
					
					try{

						$response = Http::withHeaders($headers)->get($this->base_uri . $endpoint);

						$body = json_decode($response->body());

					} catch(GuzzleHttp\Exception\ClientException $ex){


						$body = json_decode(json_encode(['success' => false, 
							                             'type'=>'ClientException', 
							                             'StatusCode' => $ex->getCode(), 
							                             'message'=> 'No se pudo conectar con el servicio',
							                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
							                         	)
											);

					} catch (ClientErrorResponseException $exception) {

						$body = json_decode(json_encode(['success' => false, 
								                             'type' => 'ClientErrorResponseException', 
							 	                             'StatusCode' => $ex->getCode(), 
							 	                             'error' => 'No se pudo conectar con el servicio',
							 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
							 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
							 	                           ])
												);
						
					} catch (\GuzzleHttp\Exception\ConnectException $ex) {

						$body = json_decode(json_encode(['success' => false, 
												             'type' => 'connection', 
												             'StatusCode' => 500, 
												             'error' => 
												             'No se pudo conectar con el servicio',
												             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
												             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
												         ]) 
							                    );
						
					} catch (BadResponseException $ex) {
						   	    
						  $body = json_decode(json_encode(['success' => false, 
						    								 'type' => 'BadResponseException', 
						    								 'StatusCode' => $ex->getCode(), 
						    								 'error' => 'No se pudo conectar con el servicio',  
						    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
						    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
						    								])
												);
						    
						    // do something with json string...
					} catch (\GuzzleHttp\Exception\RequestException $ex) {

					  	$body = json_decode(json_encode(['success' => false, 
					  									     'type' => 'request', 
					  									     'StatusCode' => $ex->getCode(), 
					  									     'error' => json_decode($ex->getResponse()),
					  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
					  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


					  									    ])
					  	    					);
					  		
					} catch(ConnectionException $ex){
						
						
						$body = json_decode(json_encode(['success' => false, 
					  									     'type' => 'request', 
					  									     'StatusCode' => $ex->getCode(), 
					  									     'error' => 'Error de conexión',
					  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
					  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


					  									    ])
					  	    					);
					}
					
					break;
				
				case 'post':
				
					try{
					
						$response = Http::withHeaders($headers)->post($this->base_uri . $endpoint, $data);
						
						$body = json_decode($response->body());



					} catch(GuzzleHttp\Exception\ClientException $ex){


						$body = json_decode(json_encode(['success' => false, 
							                             'type'=>'ClientException', 
							                             'StatusCode' => $ex->getCode(), 
							                             'message'=> 'No se pudo conectar con el servicio',
							                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
							                         	)
											);

					} catch (ClientErrorResponseException $exception) {

						$body = json_decode(json_encode(['success' => false, 
								                             'type' => 'ClientErrorResponseException', 
							 	                             'StatusCode' => $ex->getCode(), 
							 	                             'error' => 'No se pudo conectar con el servicio',
							 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
							 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
							 	                           ])
												);
						
					} catch (\GuzzleHttp\Exception\ConnectException $ex) {

						$body = json_decode(json_encode(['success' => false, 
												             'type' => 'connection', 
												             'StatusCode' => 500, 
												             'error' => 
												             'No se pudo conectar con el servicio',
												             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
												             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
												         ]) 
							                    );
						
					} catch (BadResponseException $ex) {
						   	    
						  $body = json_decode(json_encode(['success' => false, 
						    								 'type' => 'BadResponseException', 
						    								 'StatusCode' => $ex->getCode(), 
						    								 'error' => 'No se pudo conectar con el servicio',  
						    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
						    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
						    								])
												);
						    
						    // do something with json string...
					} catch (\GuzzleHttp\Exception\RequestException $ex) {

					  	$body = json_decode(json_encode(['success' => false, 
					  									     'type' => 'request', 
					  									     'StatusCode' => $ex->getCode(), 
					  									     'error' => json_decode($ex->getResponse()),
					  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
					  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


					  									    ])
					  	    					);
					  		
					} 

					//dd($body);




				break;


				case 'put':

					try{
					
						$response = Http::withHeaders($headers)->put($this->base_uri . $endpoint, $data);
						
						$body = json_decode($response->body());
						//dd($this->base_uri . $endpoint);


					} catch(GuzzleHttp\Exception\ClientException $ex){


						$body = json_decode(json_encode(['success' => false, 
							                             'type'=>'ClientException', 
							                             'StatusCode' => $ex->getCode(), 
							                             'message'=> 'No se pudo conectar con el servicio',
							                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
							                         	)
											);

					} catch (ClientErrorResponseException $exception) {

						$body = json_decode(json_encode(['success' => false, 
								                             'type' => 'ClientErrorResponseException', 
							 	                             'StatusCode' => $ex->getCode(), 
							 	                             'error' => 'No se pudo conectar con el servicio',
							 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
							 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
							 	                           ])
												);
						
					} catch (\GuzzleHttp\Exception\ConnectException $ex) {

						$body = json_decode(json_encode(['success' => false, 
												             'type' => 'connection', 
												             'StatusCode' => 500, 
												             'error' => 
												             'No se pudo conectar con el servicio',
												             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
												             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
												         ]) 
							                    );
						
					} catch (BadResponseException $ex) {
						   	    
						  $body = json_decode(json_encode(['success' => false, 
						    								 'type' => 'BadResponseException', 
						    								 'StatusCode' => $ex->getCode(), 
						    								 'error' => 'No se pudo conectar con el servicio',  
						    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
						    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
						    								])
												);
						    
						    // do something with json string...
					} catch (\GuzzleHttp\Exception\RequestException $ex) {

					  	$body = json_decode(json_encode(['success' => false, 
					  									     'type' => 'request', 
					  									     'StatusCode' => $ex->getCode(), 
					  									     'error' => json_decode($ex->getResponse()),
					  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
					  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


					  									    ])
					  	    					);
					  		
					} 

				




				break;
			}

		return $body;


	}


	public function login($endpoint, $data){
		
		//print_r(json_encode($data));
		try{

			//$response = Http::post($this->base_uri . $endpoint, 
							//	$data
							//);
			$headers = ['Content-Type' => 'application/json; charset=UTF8',
				  'timeout' => 10,
			      ];

			$response = Http::withHeaders($headers)->post($this->base_uri . $endpoint, $data);

			$body = json_decode($response->body());

		} catch(GuzzleHttp\Exception\ClientException $ex){


		$body = json_decode(json_encode(['success' => false, 
			                             'type'=>'ClientException', 
			                             'StatusCode' => $ex->getCode(), 
			                             'message'=> 'No se pudo conectar con el servicio',
			                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
			                         	)
							);

		} catch (ClientErrorResponseException $exception) {

			$body = json_decode(json_encode(['success' => false, 
				                             'type' => 'ClientErrorResponseException', 
			 	                             'StatusCode' => $ex->getCode(), 
			 	                             'error' => 'No se pudo conectar con el servicio',
			 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
			 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
			 	                           ])
								);
		
		} catch (\GuzzleHttp\Exception\ConnectException $ex) {

			$body = json_decode(json_encode(['success' => false, 
								             'type' => 'connection', 
								             'StatusCode' => 500, 
								             'error' => 
								             'No se pudo conectar con el servicio',
								             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
								             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
								         ]) 
			                    );
		
		} catch (BadResponseException $ex) {
		   	    
		    $body = json_decode(json_encode(['success' => false, 
		    								 'type' => 'BadResponseException', 
		    								 'StatusCode' => $ex->getCode(), 
		    								 'error' => 'No se pudo conectar con el servicio',  
		    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
		    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
		    								])
								);
		    
		    // do something with json string...
		} catch (\GuzzleHttp\Exception\RequestException $ex) {

	  		$body = json_decode(json_encode(['success' => false, 
	  									     'type' => 'request', 
	  									     'StatusCode' => $ex->getCode(), 
	  									     'error' => json_decode($ex->getResponse()),
	  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
	  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


	  									    ])
	  	    					);
	  		
		} 

		//dd($body);

		return $body;
	}



		/**
	* Servicios sin autenticacion 
	* @param $endpoint
	* @param int $page
	* @return mixed
	*/
	public function getPublic($endpoint, $token) {
		try{

			$request = Http::withHeaders([
					    'Content-Type' => 'application/json; charset=UTF8',
					    'timeout' => 10
						])->get($this->base_uri . $endpoint);


		//dd($request->status());

			$body = json_decode($request->body());

		} catch(GuzzleHttp\Exception\ClientException $ex){


		$body = json_decode(json_encode(['success' => false, 
			                             'type'=>'ClientException', 
			                             'StatusCode' => $ex->getCode(), 
			                             'message'=> 'No se pudo conectar con el servicio',
			                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
			                         	)
							);

		} catch (ClientErrorResponseException $exception) {

			$body = json_decode(json_encode(['success' => false, 
				                             'type' => 'ClientErrorResponseException', 
			 	                             'StatusCode' => $ex->getCode(), 
			 	                             'error' => 'No se pudo conectar con el servicio',
			 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
			 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
			 	                           ])
								);
		
		} catch (\GuzzleHttp\Exception\ConnectException $ex) {

			$body = json_decode(json_encode(['success' => false, 
								             'type' => 'connection', 
								             'StatusCode' => 500, 
								             'error' => 
								             'No se pudo conectar con el servicio',
								             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
								             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
								         ]) 
			                    );
		
		} catch (BadResponseException $ex) {
		   	    
		    $body = json_decode(json_encode(['success' => false, 
		    								 'type' => 'BadResponseException', 
		    								 'StatusCode' => $ex->getCode(), 
		    								 'error' => 'No se pudo conectar con el servicio',  
		    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
		    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
		    								])
								);
		    
		    // do something with json string...
		} catch (\GuzzleHttp\Exception\RequestException $ex) {

	  		$body = json_decode(json_encode(['success' => false, 
	  									     'type' => 'request', 
	  									     'StatusCode' => $ex->getCode(), 
	  									     'error' => json_decode($ex->getResponse()),
	  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
	  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


	  									    ])
	  	    					);
	  		
		} 


		
		
		
		return $body;
	}


	public function postPublic($endpoint, $array) {

		//dd($this->base_uri . $endpoint);
		try{
			$request = Http::withHeaders([
					    'Content-Type' => 'application/json; charset=UTF8',
					    'timeout' => 20
						])->post($this->base_uri  . $endpoint, $array);

			 
			/*$body = $request->body();
			$statusCode = $request->status();
			
			$response = $request->json();
			*///$response['statusCode']= $statusCode;
			$body = json_decode($request->body());

		} catch(GuzzleHttp\Exception\ClientException $ex){


		$body = json_decode(json_encode(['success' => false, 
			                             'type'=>'ClientException', 
			                             'StatusCode' => $ex->getCode(), 
			                             'message'=> 'No se pudo conectar con el servicio',
			                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
			                         	)
							);

		} catch (ClientErrorResponseException $exception) {

			$body = json_decode(json_encode(['success' => false, 
				                             'type' => 'ClientErrorResponseException', 
			 	                             'StatusCode' => $ex->getCode(), 
			 	                             'error' => 'No se pudo conectar con el servicio',
			 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
			 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
			 	                           ])
								);
		
		} catch (\GuzzleHttp\Exception\ConnectException $ex) {

			$body = json_decode(json_encode(['success' => false, 
								             'type' => 'connection', 
								             'StatusCode' => 500, 
								             'error' => 
								             'No se pudo conectar con el servicio',
								             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
								             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
								         ]) 
			                    );
		
		} catch (BadResponseException $ex) {
		   	    
		    $body = json_decode(json_encode(['success' => false, 
		    								 'type' => 'BadResponseException', 
		    								 'StatusCode' => $ex->getCode(), 
		    								 'error' => 'No se pudo conectar con el servicio',  
		    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
		    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
		    								])
								);
		    
		    // do something with json string...
		} catch (\GuzzleHttp\Exception\RequestException $ex) {

	  		$body = json_decode(json_encode(['success' => false, 
	  									     'type' => 'request', 
	  									     'StatusCode' => $ex->getCode(), 
	  									     'error' => json_decode($ex->getResponse()),
	  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
	  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


	  									    ])
	  	    					);
	  		
		} 

		

		//dd($body);
		return $body;
	}



	/*
	*
	*
	* Request with authorization (management)
	* 
	*
	*/

	/**
	* @param $endpoint
	* @param int $page
	* @return mixed
	*/
	public function get($endpoint, $token) {

		try{
		
			$response = Http::withHeaders([
						    'Content-Type' => 'application/json; charset=UTF8',
						    'timeout' => 10,
						    'Authorization' => 'Bearer '.Session::get('userInfo')->data->access_token
							])->get($this->base_uri . $endpoint);

			$body = json_decode($response->body());

			//dd($response->body());
		}  catch(GuzzleHttp\Exception\ClientException $ex){


		$body = json_decode(json_encode(['success' => false, 
			                             'type'=>'ClientException', 
			                             'StatusCode' => $ex->getCode(), 
			                             'message'=> 'No se pudo conectar con el servicio',
			                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
			                         	)
							);

		} catch (ClientErrorResponseException $exception) {

			$body = json_decode(json_encode(['success' => false, 
				                             'type' => 'ClientErrorResponseException', 
			 	                             'StatusCode' => $ex->getCode(), 
			 	                             'error' => 'No se pudo conectar con el servicio',
			 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
			 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
			 	                           ])
								);
		
		} catch (\GuzzleHttp\Exception\ConnectException $ex) {

			$body = json_decode(json_encode(['success' => false, 
								             'type' => 'connection', 
								             'StatusCode' => 500, 
								             'error' => 
								             'No se pudo conectar con el servicio',
								             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
								             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
								         ]) 
			                    );
		
		} catch (BadResponseException $ex) {
		   	    
		    $body = json_decode(json_encode(['success' => false, 
		    								 'type' => 'BadResponseException', 
		    								 'StatusCode' => $ex->getCode(), 
		    								 'error' => 'No se pudo conectar con el servicio',  
		    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
		    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
		    								])
								);
		    
		    // do something with json string...
		} catch (\GuzzleHttp\Exception\RequestException $ex) {

	  		$body = json_decode(json_encode(['success' => false, 
	  									     'type' => 'request', 
	  									     'StatusCode' => $ex->getCode(), 
	  									     'error' => json_decode($ex->getResponse()),
	  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
	  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


	  									    ])
	  	    					);
	  		
		} 

		//dd($body);
		return $body;
	}




	/**
	* @param $endpoint
	* @param int $page
	* @return mixed
	*/
	public function post($endpoint, $token) {

		try{
		
			$response = Http::withHeaders([
						    'Content-Type' => 'application/json; charset=UTF8',
						    'timeout' => 10,
						    'Authorization' => 'Bearer '.Session::get('userInfo')->data->access_token
							])->post($this->base_uri . $endpoint);

			$body = json_decode($request->body());

			//dd($response->body());
		}  catch(GuzzleHttp\Exception\ClientException $ex){


		$body = json_decode(json_encode(['success' => false, 
			                             'type'=>'ClientException', 
			                             'StatusCode' => $ex->getCode(), 
			                             'message'=> 'No se pudo conectar con el servicio',
			                         	 'Data' => 'Ha ocurrido un problema al intentar la conexión.']
			                         	)
							);

		} catch (ClientErrorResponseException $exception) {

			$body = json_decode(json_encode(['success' => false, 
				                             'type' => 'ClientErrorResponseException', 
			 	                             'StatusCode' => $ex->getCode(), 
			 	                             'error' => 'No se pudo conectar con el servicio',
			 	                             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
			 	                             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
			 	                           ])
								);
		
		} catch (\GuzzleHttp\Exception\ConnectException $ex) {

			$body = json_decode(json_encode(['success' => false, 
								             'type' => 'connection', 
								             'StatusCode' => 500, 
								             'error' => 
								             'No se pudo conectar con el servicio',
								             'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio' ,
								             'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
								         ]) 
			                    );
		
		} catch (BadResponseException $ex) {
		   	    
		    $body = json_decode(json_encode(['success' => false, 
		    								 'type' => 'BadResponseException', 
		    								 'StatusCode' => $ex->getCode(), 
		    								 'error' => 'No se pudo conectar con el servicio',  
		    								 'Data' => 'Ha ocurrido un problema con la url y no se ha podido conectar con el servicio',
		    								 'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 
		    								])
								);
		    
		    // do something with json string...
		} catch (\GuzzleHttp\Exception\RequestException $ex) {

	  		$body = json_decode(json_encode(['success' => false, 
	  									     'type' => 'request', 
	  									     'StatusCode' => $ex->getCode(), 
	  									     'error' => json_decode($ex->getResponse()),
	  									     'Data' => 'Ha ocurrido un problema al intentar la conexión con el servicio',
	  									     'message' => $ex->getCode() . ' Ha ocurrido un problema al intentar realizar la conexión ' 


	  									    ])
	  	    					);
	  		
		} 

		return $body;
	}





}