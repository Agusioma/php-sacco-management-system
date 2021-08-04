<?php                           $from = "contact@sacco.terrence-aluda.com";
                              $to      = "terryterrence200@gmail.com";
                              $subject = "DEPOSIT TRANSACTION DETAILS";
                              $message = "Hello ".$row['firstname']." ".$row['lastname'].",\n You have successfully deposited Ksh. ".$amountReceived." into your JUJA BUSINESS COMMUNITY SACCO Savings account. Here are the details: \n
                                  <html>
                                  <head>
                                  <title>HTML email</title>
                                  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css' integrity='sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4' crossorigin='anonymous'>
                                  </head>
                                  <body>
                                  <p>This email contains HTML Tags!</p>
                                  <div class='d-flex align-items-center justify-content-center vw-100 vh-100' style='padding-bottom: 3vh'>
                                  <div  class='card container' style='min-width: 90vw'>                
                                      <div class='card-body row'style='min-width: 90vw;'>
                                      <div class='col-md-12  d-flex align-items-center justify-content-center'>                
                                                  <div class='card-body' style=' max-width: 95vw;'>  
                                                  <div class='mb-1'>
                                                        <div class='d-flex vw-50' style='text-align: left'>
                                                          <h5 style='color: rgb(0,128,129)'>AMOUNT:&nbsp;</h5><h6 id='myName' style='color: black'>".$amountReceived."</h6>
                                                        </div>
                                                  </div>
                                                  <div class='mb-1'>
                                                        <div class='d-flex vw-50' style='text-align: left'>
                                                          <h5 style='color: rgb(0,128,129)'>TRANSACTION ID:&nbsp;</h5><h6 id='myName' style='color: black'>".$transID."</h6>
                                                        </div>
                                                  </div>
                                                  <div class='mb-1'>
                                                        <div class='d-flex vw-50' style='text-align: left'>
                                                          <h5 style='color: rgb(0,128,129)'>DATE & TIME:&nbsp;</h5><h6 id='myName' style='color: black'>".$date."</h6>
                                                        </div>
                                                  </div>
                                                  <div class='mb-1'>
                                                        <div class='d-flex vw-50' style='text-align: left'>
                                                          <h5 style='color: rgb(0,128,129)'>CATEGORY:&nbsp;</h5><h6 id='myName' style='color: black'>DEPOSIT</h6>
                                                        </div>
                                                  </div>                                                                     
                                          </div>
                                      </div>
                                      </div>            
                                      </div>
                                  </div>    
                                  </div>
                                  </body>
                                  </html>
                                  If you did not initiate this transaction, please reply to this email as soon as possible.\n Regards,\nJBCS Support.\n";
                              ///$headers = $from;
                              $headers = 'MIME-Version: 1.0' . "\r\n";
                              $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                              
                              // More headers
                              $headers .= 'From: '.$from. "\r\n";
                              mail($to, $subject, $message, $headers);

                              ?>