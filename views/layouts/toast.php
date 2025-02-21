<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    #toastBox {
        position: fixed;
        top: 70px;
        right: 30px;
        display: flex;
        align-items: flex-end;
        flex-direction: column;
        overflow: hidden;
        padding: 20px;
        z-index: 1000;
    }

    .toast {
        font-size: 14px;
        width: 350px;
        height: 50px;
        background: #fff;
        font-weight: 500;
        margin: 10px 0;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        position: relative;
        border-radius: 5px;
        padding: 0 20px;
        color: #333;
        /* Default text color */
    }

    .toast i {
        margin: 0 15px;
        font-size: 24px;
        color: green;
    }

    .toast.error i {
        color: red;
    }

    .toast.invalid i {
        color: orange;
    }

    .toast::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 5px;
        background: green;
        animation: anim 5s linear forwards;
    }

    @keyframes anim {
        100% {
            width: 0;
        }
    }

    .toast.error::after {
        background: red;
    }

    .toast.invalid::after {
        background: orange;
    }
</style>

<div id="toastBox"></div>

<script>
    let toastBox = document.getElementById('toastBox');

    function showToast(message) {
        let toast = document.createElement('div');
        toast.classList.add('toast');

        // Add icon and message
        toast.innerHTML = `<i class="fa fa-info"></i> ${message}`;
        toastBox.appendChild(toast);

        // Add appropriate class based on message content
        if (message.toLowerCase().includes('error')) {
            toast.classList.add('error');
        }
        if (message.toLowerCase().includes('invalid')) {
            toast.classList.add('invalid');
        }

        // Remove the toast after 5 seconds
        setTimeout(() => {
            toast.remove();
        }, 5000); // 5000ms = 5 seconds
    }

    // Example usage
    showToast("Error: Hello, this is an error message!");
    showToast("Invalid: This is an invalid operation.");
    showToast("Info: This is a normal message.");
</script>