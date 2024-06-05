document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.follow-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = this.dataset.userId;
            const action = this.querySelector('button').value;

            fetch('/MarcusMallia-PHPsynoptic/scripts/follow_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    user_id: userId,
                    action: action,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.action === 'follow') {
                        this.querySelector('button').value = 'unfollow';
                        this.querySelector('button').innerText = 'Unfollow';
                    } else {
                        this.querySelector('button').value = 'follow';
                        this.querySelector('button').innerText = 'Follow';
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
