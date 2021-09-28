// JavaScript anonymous function
(() => {
    if (window.localStorage) {

        // If there is no item as 'reload' in localstorage then create one & reload the page
        if (!localStorage.getItem('reload')) {
            localStorage['reload'] = true;
            window.location.reload();
        } else {

            // If there exists a 'reload' item then clear the 'reload' item in local storage
            localStorage.removeItem('reload');
        }
    }
})(); // Calling anonymous function here only
