import { FlatCompat } from "@eslint/eslintrc";
import babelParser from "@babel/eslint-parser";
import vuePlugin from "eslint-plugin-vue";
import prettierPlugin from "eslint-plugin-prettier";

const compat = new FlatCompat({
    parser: babelParser,
});

export default [
    {
        files: ["**/*.js", "**/*.vue"],
        languageOptions: {
            globals: {
                window: true,
                L: true,
                THREE: true,
                Utils: true,
                Stripe: true,
                routeMan: true,
                fabric: true,
                service: true,
            },
        },
        plugins: {
            vue: vuePlugin,
            prettier: prettierPlugin,
        },
        rules: {
            "prettier/prettier": "error",
            "comma-dangle": [
                "error",
                {
                    arrays: "never",
                    objects: "never",
                    imports: "never",
                    exports: "never",
                    functions: "ignore",
                },
            ],
            "prefer-destructuring": [
                "error",
                {
                    array: true,
                    object: false,
                },
                {
                    enforceForRenamedProperties: false,
                },
            ],
            "arrow-parens": "off",
            "function-paren-newline": "off",
            "import/no-unresolved": "off",
            "import/extensions": "off",
            "vue/no-unused-components": [
                "error",
                {
                    ignoreWhenBindingPresent: false,
                },
            ],
            "no-console": "off",
            "no-param-reassign": "off",
            "vue/no-parsing-error": [
                "error",
                {
                    "x-invalid-end-tag": false,
                    "control-character-in-input-stream": false,
                },
            ],
            "vue/no-use-v-if-with-v-for": [
                "error",
                {
                    allowUsingIterationVar: true,
                },
            ],
            "max-len": [
                "error",
                {
                    code: 150,
                    ignoreUrls: true,
                    ignoreStrings: true,
                },
            ],
            "vue/html-indent": [
                "error",
                2,
                {
                    attribute: 1,
                    baseIndent: 1,
                    closeBracket: 0,
                    alignAttributesVertically: false,
                    ignores: [],
                },
            ],
        },
    },
    ...compat.config({
        extends: [
            "plugin:vue/essential",
            "@vue/airbnb",
            "plugin:prettier/recommended",
        ],
    }),
];
