module.exports = function (grunt) {
  // Grunt Configuration
  grunt.initConfig({
//      less: {
//         app: {
//            files: { "css/articles.css": "less/articles.less",
//                     "css/galeria.css": "less/galeria.less",
// //                    "css/phocadownload.css": "less/phocadownload.less",
// //                    "css/search.css": "less/search.less",
//                     "css/template.css": "less/template.less",
//                     "css/editor.css": "less/editor.less",
//                     "css/gk.stuff.css": "less/gk.stuff.less",
//                     "css/menu_footer.css": "less/menu_footer.less",
//                     "css/social.css": "less/social.less",
//                     "css/offline.css": "less/offline.less",
//                     "css/users.css": "less/users.less"
//            }
//         }
//      },
   copy:{
     app: {
       files: [
         // includes files within path
         {expand: true, src: ['*'], dest: '/home/mcueto/development/FREE_SOFTWARE_COLABORATIONS/SCRIPTS/image_multi_resizer/', filter: 'isFile'},

         // includes files within path and its sub-directories
        //  {expand: true, src: ['**'], dest: '/home/mcueto/development/FREE_SOFTWARE_COLABORATIONS/SCRIPTS/image_multi_resizer/'},

         // makes all src relative to cwd
        //  {expand: true, cwd: '', src: ['**'], dest: '/home/mcueto/development/FREE_SOFTWARE_COLABORATIONS/SCRIPTS/image_multi_resizer/'},

         // flattens results to a single level
        //  {expand: true, flatten: true, src: ['**'], dest: '/home/mcueto/development/FREE_SOFTWARE_COLABORATIONS/SCRIPTS/image_multi_resizer/', filter: 'isFile'},
       ]
     }
   },
   watch: {
      app: {
         files: ["*"],
         tasks: ["copy:app"],
         options: {
             livereload: true,
             spawn: false
         }
      }
   }
});

// Load plugins
// grunt.loadNpmTasks("grunt-contrib-less");
grunt.loadNpmTasks('grunt-contrib-copy');
grunt.loadNpmTasks("grunt-contrib-watch");
};
