
// // document.addEventListener("DOMContentLoaded", () => {
// //   const slides = document.querySelectorAll("#carousel-container > div");
// //   const prevButton = document.getElementById("prev-slide");
// //   const nextButton = document.getElementById("next-slide");
// //   let currentSlide = 0;

// //   // current slide
// //   function showSlide(index) {
// //     slides.forEach((slide, i) => {
// //       slide.classList.toggle("hidden", i !== index);
// //     });
// //   }

// //   // next cards
// //   nextButton.addEventListener("click", () => {
// //     currentSlide = (currentSlide + 1) % slides.length;
// //     showSlide(currentSlide);
// //   });

// //   // back
// //   prevButton.addEventListener("click", () => {
// //     currentSlide = (currentSlide - 1 + slides.length) % slides.length;
// //     showSlide(currentSlide);
// //   });

// //   // show first card para nindut ang mo gawas
// //   showSlide(currentSlide);
// // });


// //image zoom

// const zoomImage = document.getElementById('zoom-image');

// zoomImage.addEventListener('mousemove', (e) => {
//   const { left, top, width, height } = zoomImage.getBoundingClientRect();
//   const x = ((e.clientX - left) / width) * 100;
//   const y = ((e.clientY - top) / height) * 100;

//   zoomImage.style.transformOrigin = `${x}% ${y}%`;
//   zoomImage.style.transform = 'scale(2)'; // Zoom effect
// });

// zoomImage.addEventListener('mouseleave', () => {
//   zoomImage.style.transformOrigin = 'center center';
//   zoomImage.style.transform = 'scale(1)'; // Reset zoom
// });


// const zoomImage2 = document.getElementById('zoom-image-2');

// zoomImage2.addEventListener('mousemove', (e) => {
//   const { left, top, width, height } = zoomImage2.getBoundingClientRect();
//   const x = ((e.clientX - left) / width) * 100;
//   const y = ((e.clientY - top) / height) * 100;

//   zoomImage2.style.transformOrigin = `${x}% ${y}%`;
//   zoomImage2.style.transform = 'scale(2)'; // Zoom effect
// });

// zoomImage2.addEventListener('mouseleave', () => {
//   zoomImage2.style.transformOrigin = 'center center';
//   zoomImage2.style.transform = 'scale(1)'; // Reset zoom
// });

// const zoomImage3 = document.getElementById("zoom-image-3")

// zoomImage3.addEventListener('mousemove', (e) => {
//   const { left, top, width, height } = zoomImage3.getBoundingClientRect();
//   const x = ((e.clientX - left) / width) * 100;
//   const y = ((e.clientY - top) / height) * 100;

//   zoomImage3.style.transformOrigin = `${x}% ${y}%`;
//   zoomImage3.style.transform = 'scale(2)'; // Zoom effect
// });

// zoomImage3.addEventListener('mouseleave', () => {
//   zoomImage3.style.transformOrigin = 'center center';
//   zoomImage3.style.transform = 'scale(1)'; // Reset zoom
// });


// const zoomImage4 = document.getElementById("zoom-image-4")

// zoomImage4.addEventListener('mousemove', (e) => {
//   const { left, top, width, height } = zoomImage4.getBoundingClientRect();
//   const x = ((e.clientX - left) / width) * 100;
//   const y = ((e.clientY - top) / height) * 100;

//   zoomImage4.style.transformOrigin = `${x}% ${y}%`;
//   zoomImage4.style.transform = 'scale(2)'; // Zoom effect
// });

// zoomImage4.addEventListener('mouseleave', () => {
//   zoomImage4.style.transformOrigin = 'center center';
//   zoomImage4.style.transform = 'scale(1)'; // Reset zoom
// });