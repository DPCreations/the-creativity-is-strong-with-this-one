Should _someone_ be able to log into an account, and only access that data? For this task, I'm going to assume that this is not the case. 

I'm going to order the accounts by name, for a nice display in a CRUD view later on. This could also be accepted as a parameter for better sorting.

Should the date of the transaction always be "now"? This would be weird, then we wouldn't need the explicit date field, as we would just be able to use created_at. Therefore, I'm going to assume that the date should be somewhere between now and an infinete future. 

This would also mean that the balance of an account only should calculate transactions that's in the past.

 Should the description be nullable? I think it should. We'll make it nullable.
 
 It seems a little weird to have transaction storage and listing in one controller, and deletion in another controller. However, the deletion process doesn't have anything to do with the accounts, so for now I'll leave it as is.
 
 To ensure that "now" will not throw an error for being in the past, I'm going to use both Carbon inPast() and carbon inSameMinute().
 
   
 
 
