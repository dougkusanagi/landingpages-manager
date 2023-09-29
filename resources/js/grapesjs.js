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

import "../css/grapesjs.css";
import "grapesjs/dist/css/grapes.min.css";
import "grapick/dist/grapick.min.css";
import "grapesjs-uppy/dist/grapesjs-uppy.min.css";

(async () => {
    const id = route().params.id;
    const urlStore = route("landing-page.update-template", id);
    const urlLoad = route("landing-page.load", id);
    const csrf = document.querySelector('meta[name="_token"]').content;
    const headers = { "X-CSRF-TOKEN": csrf };
    const template_empty = {
        assets: [],
        styles: [],
        pages: [{ frames: [{}] }],
    };

    const escapeName = (name) =>
        `${name}`.trim().replace(/([^a-z0-9\w-:/]+)/gi, "-");

    const editor = grapesjs.init({
        container: "#gjs",
        height: "100%",
        fromElement: true,
        // storageManager: false,
        storageManager: {
            type: "remote",
            stepsBeforeSave: 1,
            options: {
                remote: {
                    headers, // Custom headers for the remote storage request
                    urlStore, // Endpoint URL where to store data project
                    urlLoad, // Endpoint URL where to load data project

                    onLoad: (result) => {
                        return result.data ?? template_empty;
                    },
                    onStore: (data, editor) => {
                        const pagesHtml = editor.Pages.getAll().map((page) => {
                            const component = page.getMainComponent();

                            return {
                                html: editor.getHtml({ component }),
                                css: editor.getCss({ component }),
                            };
                        });

                        return { id, data, pagesHtml };
                    },

                    fetchOptions: (opts) =>
                        opts.method === "POST" ? { method: "PUT" } : {},
                },
            },
        },
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
                // screencapture: true,
            },
        },
    });
})();
