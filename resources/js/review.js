const reviewForm = document.getElementById('review-form');

// Te input the user writes in
const reviewCommentInput = document.getElementById('review-form-comment');
// The actual input that gets submitted
const reviewCommentFormInput = document.getElementById('review-form-comment-input');

const reviewRatingValue = document.getElementById('review-form-rating-value');
const reviewRatingUp = document.getElementById('review-rating-up-button');
const reviewRatingDown = document.getElementById('review-rating-down-button');
const reviewRatingInput = document.getElementById('review-form-rating-input');

// Change the height of the textarea automatically
reviewCommentInput.addEventListener('input', (e) => {
    reviewCommentFormInput.value = reviewCommentInput.innerText;
})

reviewRatingUp.addEventListener('click', (e) => {
    // Validate current input
    if (reviewRatingValue.dataset.value > 5) {
        reviewRatingValue.dataset.value = '5';
        reviewRatingValue.innerText = "5/5";
    } else if (reviewRatingValue.dataset.value < 0) {
        reviewRatingValue.dataset.value = '0';
        reviewRatingValue.innerText = "0/5";
    }

    if (reviewRatingValue.dataset.value < 5) {
        reviewRatingValue.dataset.value++;
        reviewRatingValue.innerText = reviewRatingValue.dataset.value + "/5";
        reviewRatingInput.value = reviewRatingValue.dataset.value;
    }
})

reviewRatingDown.addEventListener('click', (e) => {
    // Validate current input
    if (reviewRatingValue.dataset.value > 5) {
        reviewRatingValue.dataset.value = '5';
        reviewRatingValue.innerText = "5/5";
    } else if (reviewRatingValue.dataset.value < 0) {
        reviewRatingValue.dataset.value = '0';
        reviewRatingValue.innerText = "0/5";
    }
    if (reviewRatingValue.dataset.value > 0) {
        reviewRatingValue.dataset.value--;
        reviewRatingValue.innerText = reviewRatingValue.dataset.value + "/5";
        reviewRatingInput.value = reviewRatingValue.dataset.value;
    }
})