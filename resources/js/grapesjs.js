import grapesjs from "grapesjs";
import grapesjsTailwind from "grapesjs-tailwind";
import grapesjsForms from "grapesjs-plugin-forms";
import grapesjsPresetWebpage from "grapesjs-preset-webpage";
import grapesjsStyleBg from "grapesjs-style-bg";
import grapesjsCkeditor from "grapesjs-plugin-ckeditor";
import grapesjsTuiImageEditor from "grapesjs-tui-image-editor";
import grapesjsCustomCode from "grapesjs-custom-code";
import grapesjsGa from "grapesjs-ga";
import grapesjsUppy from "grapesjs-uppy";
import grapesjsMjml from "grapesjs-mjml";

import "grapesjs/dist/css/grapes.min.css";
import "grapick/dist/grapick.min.css";
import "grapesjs-uppy/dist/grapesjs-uppy.min.css";

const escapeName = (name) =>
    `${name}`.trim().replace(/([^a-z0-9\w-:/]+)/gi, "-");

grapesjs.init({
    container: "#gjs",
    height: "100%",
    fromElement: true,
    storageManager: false,
    selectorManager: { escapeName },
    plugins: [
        grapesjsTailwind,
        grapesjsForms,
        grapesjsPresetWebpage,
        grapesjsStyleBg,
        grapesjsCkeditor,
        grapesjsTuiImageEditor,
        grapesjsCustomCode,
        grapesjsGa,
        grapesjsUppy,
        // grapesjsMjml,
    ],
    pluginsOpts: {
        "grapesjs-uppy": {
            googledrive: false,
            dropbox: false,
            instagram: false,
            facebook: false,
            onedrive: false,
            unsplash: false,
            webcam: false,
            screencapture: true,
        },
    },
});
