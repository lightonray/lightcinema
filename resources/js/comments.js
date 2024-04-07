$(document).ready(function() {
    // Function to fetch and display comments
    function fetchComments() {
        $.ajax({
            url: '/comments',
            method: 'GET',
            success: function(data) {
                // Clear existing comments
                $('.comments').empty();

                // Iterate through each comment and append it to the container
                data.forEach(function(comment) {
                    var commentHtml = `
                        <div class="comment">
                            <div class="comment-content">
                                <p class="comment-text">${comment.content}</p>
                                <p class="comment-meta">Posted by ${comment.user_name} on ${formatTimestamp(comment.created_at)}</p>
                            </div>
                        </div>`;
                    $('.comments').append(commentHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching comments:', error);
            }
        });
    }

    // Function to submit a new comment
    $('#comment-form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Get form data
        var formData = new FormData(this);

        // Send form data via AJAX
        $.ajax({
            url: '/comments',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                var comment = data.comment;

                var commentHtml = `
                <div class="comment">
                    <div class="comment-content">
                        <p class="comment-text">${comment.content}</p>
                        <p class="comment-meta">Posted by ${comment.user_name} on ${formatTimestamp(comment.created_at)}</p>
                    </div>
                </div>`;
            $('.comments').append(commentHtml);

                // Clear the comment input field
                $('#comment-input').val('');
            },
            error: function(xhr, status, error) {
                console.error('Error submitting comment:', error);
            }
        });
    });

    // Fetch and display comments on page load
    fetchComments();
});


function formatTimestamp(timestamp) {
    var date = new Date(timestamp);
    var options = { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
    var formattedDate = date.toLocaleString('en-US', options); // Adjust locale and formatting options as needed
    return formattedDate;
}