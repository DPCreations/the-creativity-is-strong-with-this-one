Should _someone_ be able to log into an account, and only access that data? For this task, I'm going to assume that this is not the case. 

I'm going to order the accounts by name, for a nice display in a CRUD view later on. This could also be accepted as a parameter for better sorting.

Should the date of the transaction always be "now"? This would be weird, then we wouldn't need the explicit date field, as we would just be able to use created_at. Therefore, I'm going to assume that the date should be somewhere between now and an infinete future. 

This would also mean that the balance of an account only should calculate transactions that's in the past.

Should the description be nullable? I think it should. We'll make it nullable.
 
It seems a little weird to have transaction storage and listing in one controller, and deletion in another controller. However, the deletion process doesn't have anything to do with the accounts, so for now I'll leave it as is.
 
To ensure that "now" will not throw an error for being in the past, I'm going to use both Carbon inPast() and carbon inSameMinute().
 
In the function calculating the balance for an account, we could accept two parameters. One being the start date, and one being the end date. That way we could get the balance for a given interval, but I don't think this is going to be relevant in this case. 

I'm going to add a custom exception for Transactions, for more clarity about potential issues when running tests (and when looking at Bugsnag, Sentry og the likes).

Going over the code again, I've renamed the newTransaction function on the Account model to charge instead. I think it's more descriptive. 

A note on the findOrFail method: it could be replaced with a simple find, and then a check which would allow us to create a more specific error message. Although I think this would look better in tests, I believe you're sacrificing a bit of the readibility that Laravel offers. 

Also, I'm very aware of the fact that this API is open to everyone. In the real world, this would probably be build into some sort of existing system, and therefore I've gone ahead and assumed that the access control is taken care of. It could easily be build into the system, using Laravels authentication and Sanctum for API authentication.  
