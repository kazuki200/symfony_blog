module.exports = {
  printWidth: 80,
  tabWidth: 2,
  plugins: ["prettier-plugin-twig-melody"],
  twigMelodyPlugins: ["prettier-plugin-twig-enhancements"],
  overrides: [
    {
      files: ["*.html.twig"],
      options: {
        tabWidth: 2,
      },
    },
  ],
};
