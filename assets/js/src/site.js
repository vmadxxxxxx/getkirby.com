/* Site js */

$(document).ready(function(){

  // Smooth Scrolling
  $('.to-top').click(function(event){
    event.preventDefault();
    var offset = $($(this).attr('href')).offset().top;
    $('html, body').animate({scrollTop:offset}, 700);
  });

  // Dynamic to-top link
  $('.to-top').hide();
  $(window).scroll(function(){
    if($(this).scrollTop() > 200) {
      $('.to-top').show();
    } else {
      $('.to-top').hide();
    }
  });

});


// jQuery Autocomplete
(function($) {

  var Autocomplete = function(element, dropdown) {

    var self = this;

    this.element        = $(element);
    this.customDropdown = dropdown ? true : false;
    this.dropdown       = dropdown ? $(dropdown) : $('<div class="autocomplete"></div>').hide();
    this.entered        = false;
    this.lastSearch     = false;
    this.cache          = false;
    this.fuzzy          = this.element.data('fuzzy');
    this.field          = this.element.data('field');
    this.limit          = this.element.data('limit') || 5;
    this.url            = this.element.data('url');
    this.sticky         = this.element.data('sticky');
    this.ignored        = [];
    this.template       = false;

    if(this.element.data('template')) {
      this.template = $(this.element.data('template')).html();
    }

    // keyboard shortcut helper
    this.keys = function(element, keys) {

      element.on('keydown', function(e) {
        if(keys[e.keyCode]) {
          return keys[e.keyCode]();
        }
      });

    };

    this.highlight = function(string, query) {
      var rgxp = new RegExp('^' + query, 'gi');
      return string.replace(rgxp, function(matched) {
        return '<strong>' + matched + '</strong>';
      });
    };

    this.data = function(callback) {
      if(!self.cache) {
        $.getJSON(self.url, function(data) {
          self.cache = data;
          callback(data);
        });
      }
      return callback(self.cache);
    };

    this.add = function(item) {
      var value = self.field ? item[self.field] : item;
      self.element.val(value).focus();
      self.lastSearch = value;
      self.close();
      self.focus();
      self.element.trigger('autocomplete:add', [item]);
    };

    this.close = function(focus) {
      if(!focus) focus = true;
      self.dropdown.empty().hide();
      self.element.trigger('autocomplete:close');
    };

    this.focus = function() {
      self.element.trigger('focus');
    };

    this.ignore = function(ignore) {
      var ignore = ignore.toLowerCase();
      if($.inArray(ignore, self.ignored) == -1) self.ignored.push(ignore);
    };

    this.unignore = function(unignore) {
      var unignore = unignore.toLowerCase();
      self.ignored = $.grep(self.ignored, function(value) {
        return value != unignore;
      });
    };

    this.search = function(query) {

      if(query == self.lastSearch) return true;

      self.dropdown.empty();
      self.dropdown.hide();
      self.lastSearch = query;

      if(query.length == 0) {
        self.element.trigger('autocomplete:empty');
        return false;
      }

      self.element.trigger('autocomplete:search');

      self.data(function(data) {

        var results = $.grep(data, function(item) {
          var w = self.field ? item[self.field].toLowerCase() : item.toLowerCase();
          var q = query.toLowerCase();
          if(self.fuzzy) {
            return w.indexOf(q) != -1 && $.inArray(w, self.ignored) == -1;
          } else {
            return w.indexOf(q) == 0 && $.inArray(w, self.ignored) == -1;
          }
        });

        results = results.slice(0, self.limit);

        if(results.length == 0) {
          self.dropdown.hide()
          self.element.trigger('autocomplete:noresults');
          return false;
        }

        $.each(results, function(i, item) {

          if(self.template) {

            var html = self.template;

            for(var key in item) {
              html = html.replace('{{' + key + '}}', item[key]);
            }

            var btn = $('<button type="button">' + html + '</button>');
          } else {
            var str = self.field ? item[self.field] : item;
            var btn = $('<button type="button">' + self.highlight(str, query) + '</button>');
          }

          btn.on('click', function() {
            self.add(item);
            return false;
          });

          self.keys(btn, {
            // enter
            13 : function() {
              self.add(item);
              return false;
            },
            // esc
            27: function() {
              self.close();
              self.focus();
              return false;
            },
            // up
            38 : function() {
              self.go(i-1);
              return false;
            },
            // down
            40 : function() {
              self.go(i+1);
              return false;
            },
            // backspace
            8 : function() {
              self.close();
              self.focus();
              return false;
            }
          });

          self.dropdown.append(btn);

        });

        if(self.sticky) {
          var position = self.element.position();
          position.top = position.top + self.element.outerHeight();
          self.dropdown.css(position);
        }

        self.dropdown.show();
        self.elements = self.dropdown.find('button');
        self.element.trigger('autocomplete:search');

      });

    };

    this.go = function(i) {
      if(i == -1 || !self.elements) return false;
      self.elements.eq(i).focus();
    };

    this.init = function() {

      $(document).on('click', function() {
        self.close();
      });

      self.dropdown.on('click', function(e) {
        e.stopPropagation();
      });

      self.element.attr('autocomplete', 'off');
      if(!self.customDropdown) self.element.after(self.dropdown);

      // don't search immediately for the value in the input
      self.lastSearch = self.element.val();

      self.element.on('keyup', function(e) {
        if(e.keyCode != 13) self.search(self.element.val());
      });

      self.keys(self.element, {
        // down
        40 : function() {
          self.go(0);
          return false;
        },
        // esc
        27 : function() {
          self.close();
          return false;
        }
      });

      return {
        ignore   : self.ignore,
        unignore : self.unignore,
        search   : self.search,
        close    : self.close
      };

    };

    return this.init();

  };

  $.fn.autocomplete = function(dropdown) {

    return this.each(function() {

      if($(this).data('autocomplete')) {
        return $(this).data('autocomplete');
      } else {
        var tags = new Autocomplete(this, dropdown);
        $(this).data('autocomplete', tags);
        return tags;
      }

    });

  };

})(jQuery);


/* http://prismjs.com/download.html?themes=prism-okaidia&languages=markup+css+css-extras+clike+javascript+php+php-extras */
self="undefined"!=typeof window?window:"undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?self:{};var Prism=function(){var e=/\blang(?:uage)?-(?!\*)(\w+)\b/i,t=self.Prism={util:{encode:function(e){return e instanceof n?new n(e.type,t.util.encode(e.content)):"Array"===t.util.type(e)?e.map(t.util.encode):e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/\u00a0/g," ")},type:function(e){return Object.prototype.toString.call(e).match(/\[object (\w+)\]/)[1]},clone:function(e){var n=t.util.type(e);switch(n){case"Object":var r={};for(var a in e)e.hasOwnProperty(a)&&(r[a]=t.util.clone(e[a]));return r;case"Array":return e.slice()}return e}},languages:{extend:function(e,n){var r=t.util.clone(t.languages[e]);for(var a in n)r[a]=n[a];return r},insertBefore:function(e,n,r,a){a=a||t.languages;var i=a[e],o={};for(var l in i)if(i.hasOwnProperty(l)){if(l==n)for(var s in r)r.hasOwnProperty(s)&&(o[s]=r[s]);o[l]=i[l]}return a[e]=o},DFS:function(e,n){for(var r in e)n.call(e,r,e[r]),"Object"===t.util.type(e)&&t.languages.DFS(e[r],n)}},highlightAll:function(e,n){for(var r,a=document.querySelectorAll('code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'),i=0;r=a[i++];)t.highlightElement(r,e===!0,n)},highlightElement:function(r,a,i){for(var o,l,s=r;s&&!e.test(s.className);)s=s.parentNode;if(s&&(o=(s.className.match(e)||[,""])[1],l=t.languages[o]),l){r.className=r.className.replace(e,"").replace(/\s+/g," ")+" language-"+o,s=r.parentNode,/pre/i.test(s.nodeName)&&(s.className=s.className.replace(e,"").replace(/\s+/g," ")+" language-"+o);var c=r.textContent;if(c){var g={element:r,language:o,grammar:l,code:c};if(t.hooks.run("before-highlight",g),a&&self.Worker){var u=new Worker(t.filename);u.onmessage=function(e){g.highlightedCode=n.stringify(JSON.parse(e.data),o),t.hooks.run("before-insert",g),g.element.innerHTML=g.highlightedCode,i&&i.call(g.element),t.hooks.run("after-highlight",g)},u.postMessage(JSON.stringify({language:g.language,code:g.code}))}else g.highlightedCode=t.highlight(g.code,g.grammar,g.language),t.hooks.run("before-insert",g),g.element.innerHTML=g.highlightedCode,i&&i.call(r),t.hooks.run("after-highlight",g)}}},highlight:function(e,r,a){var i=t.tokenize(e,r);return n.stringify(t.util.encode(i),a)},tokenize:function(e,n){var r=t.Token,a=[e],i=n.rest;if(i){for(var o in i)n[o]=i[o];delete n.rest}e:for(var o in n)if(n.hasOwnProperty(o)&&n[o]){var l=n[o];l="Array"===t.util.type(l)?l:[l];for(var s=0;s<l.length;++s){var c=l[s],g=c.inside,u=!!c.lookbehind,f=0;c=c.pattern||c;for(var h=0;h<a.length;h++){var d=a[h];if(a.length>e.length)break e;if(!(d instanceof r)){c.lastIndex=0;var p=c.exec(d);if(p){u&&(f=p[1].length);var m=p.index-1+f,p=p[0].slice(f),v=p.length,y=m+v,k=d.slice(0,m+1),b=d.slice(y+1),w=[h,1];k&&w.push(k);var N=new r(o,g?t.tokenize(p,g):p);w.push(N),b&&w.push(b),Array.prototype.splice.apply(a,w)}}}}}return a},hooks:{all:{},add:function(e,n){var r=t.hooks.all;r[e]=r[e]||[],r[e].push(n)},run:function(e,n){var r=t.hooks.all[e];if(r&&r.length)for(var a,i=0;a=r[i++];)a(n)}}},n=t.Token=function(e,t){this.type=e,this.content=t};if(n.stringify=function(e,r,a){if("string"==typeof e)return e;if("[object Array]"==Object.prototype.toString.call(e))return e.map(function(t){return n.stringify(t,r,e)}).join("");var i={type:e.type,content:n.stringify(e.content,r,a),tag:"span",classes:["token",e.type],attributes:{},language:r,parent:a};"comment"==i.type&&(i.attributes.spellcheck="true"),t.hooks.run("wrap",i);var o="";for(var l in i.attributes)o+=l+'="'+(i.attributes[l]||"")+'"';return"<"+i.tag+' class="'+i.classes.join(" ")+'" '+o+">"+i.content+"</"+i.tag+">"},!self.document)return self.addEventListener?(self.addEventListener("message",function(e){var n=JSON.parse(e.data),r=n.language,a=n.code;self.postMessage(JSON.stringify(t.tokenize(a,t.languages[r]))),self.close()},!1),self.Prism):self.Prism;var r=document.getElementsByTagName("script");return r=r[r.length-1],r&&(t.filename=r.src,document.addEventListener&&!r.hasAttribute("data-manual")&&document.addEventListener("DOMContentLoaded",t.highlightAll)),self.Prism}();"undefined"!=typeof module&&module.exports&&(module.exports=Prism);;
Prism.languages.markup={comment:/<!--[\w\W]*?-->/g,prolog:/<\?.+?\?>/,doctype:/<!DOCTYPE.+?>/,cdata:/<!\[CDATA\[[\w\W]*?]]>/i,tag:{pattern:/<\/?[\w:-]+\s*(?:\s+[\w:-]+(?:=(?:("|')(\\?[\w\W])*?\1|[^\s'">=]+))?\s*)*\/?>/gi,inside:{tag:{pattern:/^<\/?[\w:-]+/i,inside:{punctuation:/^<\/?/,namespace:/^[\w-]+?:/}},"attr-value":{pattern:/=(?:('|")[\w\W]*?(\1)|[^\s>]+)/gi,inside:{punctuation:/=|>|"/g}},punctuation:/\/?>/g,"attr-name":{pattern:/[\w:-]+/g,inside:{namespace:/^[\w-]+?:/}}}},entity:/\&#?[\da-z]{1,8};/gi},Prism.hooks.add("wrap",function(t){"entity"===t.type&&(t.attributes.title=t.content.replace(/&amp;/,"&"))});;
Prism.languages.css={comment:/\/\*[\w\W]*?\*\//g,atrule:{pattern:/@[\w-]+?.*?(;|(?=\s*{))/gi,inside:{punctuation:/[;:]/g}},url:/url\((["']?).*?\1\)/gi,selector:/[^\{\}\s][^\{\};]*(?=\s*\{)/g,property:/(\b|\B)[\w-]+(?=\s*:)/gi,string:/("|')(\\?.)*?\1/g,important:/\B!important\b/gi,punctuation:/[\{\};:]/g,"function":/[-a-z0-9]+(?=\()/gi},Prism.languages.markup&&Prism.languages.insertBefore("markup","tag",{style:{pattern:/<style[\w\W]*?>[\w\W]*?<\/style>/gi,inside:{tag:{pattern:/<style[\w\W]*?>|<\/style>/gi,inside:Prism.languages.markup.tag.inside},rest:Prism.languages.css}}});;
Prism.languages.css.selector={pattern:/[^\{\}\s][^\{\}]*(?=\s*\{)/g,inside:{"pseudo-element":/:(?:after|before|first-letter|first-line|selection)|::[-\w]+/g,"pseudo-class":/:[-\w]+(?:\(.*\))?/g,"class":/\.[-:\.\w]+/g,id:/#[-:\.\w]+/g}},Prism.languages.insertBefore("css","ignore",{hexcode:/#[\da-f]{3,6}/gi,entity:/\\[\da-f]{1,8}/gi,number:/[\d%\.]+/g});;
Prism.languages.clike={comment:[{pattern:/(^|[^\\])\/\*[\w\W]*?\*\//g,lookbehind:!0},{pattern:/(^|[^\\:])\/\/.*?(\r?\n|$)/g,lookbehind:!0}],string:/("|')(\\?.)*?\1/g,"class-name":{pattern:/((?:(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[a-z0-9_\.\\]+/gi,lookbehind:!0,inside:{punctuation:/(\.|\\)/}},keyword:/\b(if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/g,"boolean":/\b(true|false)\b/g,"function":{pattern:/[a-z0-9_]+\(/gi,inside:{punctuation:/\(/}},number:/\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?)\b/g,operator:/[-+]{1,2}|!|<=?|>=?|={1,3}|&{1,2}|\|?\||\?|\*|\/|\~|\^|\%/g,ignore:/&(lt|gt|amp);/gi,punctuation:/[{}[\];(),.:]/g};;
Prism.languages.javascript=Prism.languages.extend("clike",{keyword:/\b(break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|false|finally|for|function|get|if|implements|import|in|instanceof|interface|let|new|null|package|private|protected|public|return|set|static|super|switch|this|throw|true|try|typeof|var|void|while|with|yield)\b/g,number:/\b-?(0x[\dA-Fa-f]+|\d*\.?\d+([Ee]-?\d+)?|NaN|-?Infinity)\b/g}),Prism.languages.insertBefore("javascript","keyword",{regex:{pattern:/(^|[^/])\/(?!\/)(\[.+?]|\\.|[^/\r\n])+\/[gim]{0,3}(?=\s*($|[\r\n,.;})]))/g,lookbehind:!0}}),Prism.languages.markup&&Prism.languages.insertBefore("markup","tag",{script:{pattern:/<script[\w\W]*?>[\w\W]*?<\/script>/gi,inside:{tag:{pattern:/<script[\w\W]*?>|<\/script>/gi,inside:Prism.languages.markup.tag.inside},rest:Prism.languages.javascript}}});;
Prism.languages.php=Prism.languages.extend("clike",{keyword:/\b(and|or|xor|array|as|break|case|cfunction|class|const|continue|declare|default|die|do|else|elseif|enddeclare|endfor|endforeach|endif|endswitch|endwhile|extends|for|foreach|function|include|include_once|global|if|new|return|static|switch|use|require|require_once|var|while|abstract|interface|public|implements|private|protected|parent|throw|null|echo|print|trait|namespace|final|yield|goto|instanceof|finally|try|catch)\b/gi,constant:/\b[A-Z0-9_]{2,}\b/g,comment:{pattern:/(^|[^\\])(\/\*[\w\W]*?\*\/|(^|[^:])(\/\/|#).*?(\r?\n|$))/g,lookbehind:!0}}),Prism.languages.insertBefore("php","keyword",{delimiter:/(\?>|<\?php|<\?)/gi,variable:/(\$\w+)\b/gi,"package":{pattern:/(\\|namespace\s+|use\s+)[\w\\]+/g,lookbehind:!0,inside:{punctuation:/\\/}}}),Prism.languages.insertBefore("php","operator",{property:{pattern:/(->)[\w]+/g,lookbehind:!0}}),Prism.languages.markup&&(Prism.hooks.add("before-highlight",function(e){"php"===e.language&&(e.tokenStack=[],e.backupCode=e.code,e.code=e.code.replace(/(?:<\?php|<\?)[\w\W]*?(?:\?>)/gi,function(n){return e.tokenStack.push(n),"{{{PHP"+e.tokenStack.length+"}}}"}))}),Prism.hooks.add("before-insert",function(e){e.code=e.backupCode,delete e.backupCode}),Prism.hooks.add("after-highlight",function(e){if("php"===e.language){for(var n,a=0;n=e.tokenStack[a];a++)e.highlightedCode=e.highlightedCode.replace("{{{PHP"+(a+1)+"}}}",Prism.highlight(n,e.grammar,"php"));e.element.innerHTML=e.highlightedCode}}),Prism.hooks.add("wrap",function(e){"php"===e.language&&"markup"===e.type&&(e.content=e.content.replace(/(\{\{\{PHP[0-9]+\}\}\})/g,'<span class="token php">$1</span>'))}),Prism.languages.insertBefore("php","comment",{markup:{pattern:/<[^?]\/?(.*?)>/g,inside:Prism.languages.markup},php:/\{\{\{PHP[0-9]+\}\}\}/g}));;
Prism.languages.insertBefore("php","variable",{"this":/\$this/g,global:/\$_?(GLOBALS|SERVER|GET|POST|FILES|REQUEST|SESSION|ENV|COOKIE|HTTP_RAW_POST_DATA|argc|argv|php_errormsg|http_response_header)/g,scope:{pattern:/\b[\w\\]+::/g,inside:{keyword:/(static|self|parent)/,punctuation:/(::|\\)/}}});;
