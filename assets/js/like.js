document.addEventListener(
  'click',
  function (event) {
    addLike(event);
  },
  false
);

const addLike = function (event) {
  const postId =
    event.target.localName === 'img'
      ? event.target.offsetParent?.dataset?.post
      : event.target.dataset?.post;

  const clickedElement =
    event.target.localName === 'img'
      ? event.target
      : event.target.getElementsByTagName('img')[0];

  if (!postId) {
    return;
  }

  fetch('/wp-json/realestate/v1/manageLikes', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': themePath.nonce, // REST API nonce for security
    },
    body: JSON.stringify({
      postId: postId,
    }),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.message.includes('saved')) {
        clickedElement.src = themePath.path + '/assets/images/like.png';
      } else if (data.message.includes('removed')) {
        clickedElement.src = themePath.path + '/assets/images/heart.png';
      }
    })
    .catch(function (error) {
      console.error('Error:', error);
    });
};