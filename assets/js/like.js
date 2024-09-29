document.addEventListener(
  "click",
  function (e) {
    addLike(e);
  },
  false
);

const addLike = (e) => {
  const postId =
    e.target.localName === "img"
      ? e.target?.offsetParent?.dataset?.post
      : e.target?.dataset?.post;

  const clickedElement =
    e.target.localName === "img"
      ? e.target
      : e.target.getElementsByTagName("img")[0];

  fetch("/wp-json/realestate/v1/manageLikes", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-WP-Nonce": themePath.nonce, // REST API nonce for security
    },
    body: JSON.stringify({
      postId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      if (data.message.includes("saved")) {
        clickedElement.src = `${themePath.path}/assets/images/like.png`;
      }

      if (data.message.includes("removed")) {
        clickedElement.src = `${themePath.path}/assets/images/heart.png`;
      }

      //   if (data.id) {
      //     console.log("Like saved successfully.");
      //   } else {
      //     console.log("Error saving like:", data.message);
      //   }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};
