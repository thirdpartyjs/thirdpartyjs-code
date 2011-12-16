<!DOCTYPE html>
<html>
    <head>
    	<title>Setting Cookies in a New Window</title>
    </head>
    <body>
        <a id="login" href="#">Login</a>

        <div id="user-details"></div>

        <script>
            (function() {
                var popup;

                function openLoginWindow(e) {
                    e.preventDefault();

                    popup = window.open('login.php', '_blank', 'width=460,height=225');
                }

                var login = document.getElementById('login');
                if (login.addEventListener) {
                    login.addEventListener('click', openLoginWindow, false);
                } else if (login.attachEvent) {
                    login.attachEvent('onclick', openLoginWindow);
                }

                function onMessageReceived(e) {
                    var response = JSON.parse(e.data);

                    if (response.success && popup) {
                        popup.close();

                        // Remove the login link, and add the user details to the page
                        login.parentNode.removeChild(login);
                        var details = document.getElementById('user-details');
                        details.innerHTML = 'Welcome back ' + response.name;
                    }                    
                }

                if (window.addEventListener) {
                    window.addEventListener('message', onMessageReceived, false);
                } else if (window.attachEvent) {
                    window.attachEvent('onmessage', onMessageReceived);
                }

            })();
        </script>
    </body>
</html>