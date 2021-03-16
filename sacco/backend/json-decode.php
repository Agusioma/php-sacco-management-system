<?php
// Define recursive function to extract nested values
function printValues($arr) {
    global $count;
    global $values;
    
    // Check input is an array
    if(!is_array($arr)){
        die("ERROR: Input is not an array");
    }
    
    /*
    Loop through array, if value is itself an array recursively call the
    function else add the value found to the output items array,
    and increment counter by 1 for each value found
    */
    foreach($arr as $key=>$value){
        if(is_array($value)){
            printValues($value);
        } else{
            $values[] = $value;
            $count++;
        }
    }
    
    // Return total count and values found in array
    return array('total' => $count, 'values' => $values);
}
 
// Assign JSON encoded string to a PHP variable
$json = '{
            "Body":
                {"stkCallback":
                    {
                        "MerchantRequestID":"18200-5488149-1",
                        "CheckoutRequestID":"ws_CO_140320212047468752",
                        "ResultCode":0,
                        "ResultDesc":"The service request is processed successfully.",
                        "CallbackMetadata":
                        {
                            "Item":
                                [
                                    {"Name":"Amount","Value":1.00},
                                    {"Name":"MpesaReceiptNumber","Value":"PCE7OSKVZT"},
                                    {"Name":"Balance"},
                                    {"Name":"TransactionDate","Value":20210314204800},
                                    {"Name":"PhoneNumber","Value":254702277060}
                                ]
                            }
                        }
                    }
                }';
// Decode JSON data into PHP associative array format
$arr = json_decode($json, true);
 
// Call the function and print all the values
$result = printValues($arr);
echo "<h3>" . $result["total"] . " value(s) found: </h3>";
echo implode("<br>", $result["values"]);
 
echo "<hr>";
 
// Print a single value
//print_r($arr["Body"]["stkCallback"]["CallbackMetadata"]);
print($arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"])."<br>";
print($arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"])."<br>";
print($arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"])."<br>";
print($arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"])."<br>";
//echo $arr["book"]["author"] . "<br>";  // Output: J. K. Rowling
//echo $arr["book"]["characters"][0] . "<br>";  // Output: Harry Potter
//echo $arr["book"]["price"]["hardcover"];