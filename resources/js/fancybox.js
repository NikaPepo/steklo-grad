import {Fancybox} from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
document.addEventListener('DOMContentLoaded', () => {
    Fancybox.bind('[data-fancybox="about-gallery"]', {
        groupAll: true,
        dragToClose: true,
        placeFocusBack: false,
        animated: true,
        Images: {
            zoom: true,
        },
        // Image: {
        //     maxHeight: 600,
        // },
        showClass: null,
        hideClass: null,
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: [],
                right: ["prev", "next", "close"],
            },
        },
        // Carousel: {
        //     Zoomable: {
        //         Panzoom: {
        //
        //             width:  () => Math.min(window.innerWidth  * 0.8, 1200),
        //             height: () => Math.min(window.innerHeight * 0.8, 800),
        //         },
        //     },
        // },

    })
    Fancybox.bind('[data-fancybox="product"]',{
        dragToClose: true,
        animated: true,
        showClass: null,
        hideClass: null,
        Toolbar: {
            display: {
                left: ["infobar"],
                right: [ "close"],
            },
        },
    })
    Fancybox.bind('[data-fancybox="service"]',{
        dragToClose: true,
        animated: true,
        showClass: null,
        hideClass: null,
        Toolbar: {
            display: {
                left: ["infobar"],
                right: [ "close"],
            },
        },
    })
    Fancybox.bind('[data-fancybox^="album-"]', {
        dragToClose: true,
        animated: true,
        showClass: null,
        hideClass: null,
        Images: {
            zoom: false,
        },
        Toolbar: {
            display: {
                left: ["infobar"],
                right: ["prev", "next", "close"],
            },
        },
    });
});
// Fancybox.bind("[data-fancybox]", {
//     Carousel: {
//         Toolbar: {
//             display: {
//                 left: ["counter"],
//                 middle: [
//                     "zoomIn",
//                     "zoomOut",
//                     "toggle1to1",
//                     "rotateCCW",
//                     "rotateCW",
//                     "flipX",
//                     "flipY",
//                     "reset",
//                 ],
//                 right: ["autoplay", "thumbs", "close"],
//             },
//         },
//     },
// });