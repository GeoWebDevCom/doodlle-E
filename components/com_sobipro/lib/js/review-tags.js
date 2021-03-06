/* jQuery Tags Input Plugin 1.2.5 Copyright (c) 2011 XOXCO, Inc Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php ben@xoxco.com */
(function ( c ) {
    var a = new Array();
    var b = new Array();
    c.fn.addTag = function ( e, d ) {
        var d = jQuery.extend( {focus:false, callback:true}, d );
        this.each( function () {
            id = c( this ).attr( "id" );
            var g = c( this ).val().split( a[id] );
            if ( g[0] == "" ) {
                g = new Array();
            }
            e = jQuery.trim( e );
            if ( d.unique ) {
                skipTag = c( g ).tagExist( e );
            } else {
                skipTag = false;
            }
            if ( e != "" && skipTag != true ) {
                c( "<span>" ).addClass( "tag" ).append( c( "<span>" ).text( e ).append( "&nbsp;&nbsp;" ), c( "<a>", {href:"#", title:"Removing tag", text:"x"} ).click( function () {
                    return c( "#" + id ).removeTag( escape( e ) );
                } ) ).insertBefore( "#" + id + "_addTag" );
                g.push( e );
                c( "#" + id + "_tag" ).val( "" );
                if ( d.focus ) {
                    c( "#" + id + "_tag" ).focus();
                } else {
                    c( "#" + id + "_tag" ).blur();
                }
                if ( d.callback && b[id] && b[id]["onAddTag"] ) {
                    var j = b[id]["onAddTag"];
                    j( e );
                }
                if ( b[id] && b[id]["onChange"] ) {
                    var h = g.length;
                    var j = b[id]["onChange"];
                    j( c( this ), g[h] );
                }
            }
            c.fn.tagsInput.updateTagsField( this, g );
        } );
        return false;
    };
    c.fn.removeTag = function ( d ) {
        d = unescape( d );
        this.each( function () {
            id = c( this ).attr( "id" );
            var e = c( this ).val().split( a[id] );
            c( "#" + id + "_tagsinput .tag" ).remove();
            str = "";
            for ( i = 0; i < e.length; i++ ) {
                if ( e[i] != d ) {
                    str = str + a[id] + e[i];
                }
            }
            c.fn.tagsInput.importTags( this, str );
            if ( b[id] && b[id]["onRemoveTag"] ) {
                var g = b[id]["onRemoveTag"];
                g( d );
            }
        } );
        return false;
    };
    c.fn.tagExist = function ( d ) {
        if ( jQuery.inArray( d, c( this ) ) == -1 ) {
            return false;
        } else {
            return true;
        }
    };
    c.fn.importTags = function ( d ) {
        c( "#" + id + "_tagsinput .tag" ).remove();
        c.fn.tagsInput.importTags( this, d );
    };
    c.fn.tagsInput = function ( d ) {
        var e = jQuery.extend( {interactive:true, defaultText:"add a tag", minChars:0, width:"300px", height:"100px", hide:true, delimiter:",", autocomplete:{selectFirst:false}, unique:true, removeWithBackspace:true}, d );
        this.each( function () {
            if ( e.hide ) {
                c( this ).hide();
            }
            id = c( this ).attr( "id" );
            data = jQuery.extend( {pid:id, real_input:"#" + id, holder:"#" + id + "_tagsinput", input_wrapper:"#" + id + "_addTag", fake_input:"#" + id + "_tag"}, e );
            a[id] = data.delimiter;
            if ( e.onAddTag || e.onRemoveTag || e.onChange ) {
                b[id] = new Array();
                b[id]["onAddTag"] = e.onAddTag;
                b[id]["onRemoveTag"] = e.onRemoveTag;
                b[id]["onChange"] = e.onChange;
            }
            var f = '<div id="' + id + '_tagsinput" class="tagsinput"><div id="' + id + '_addTag">';
            if ( e.interactive ) {
                f = f + '<input id="' + id + '_tag" value="" data-default="' + e.defaultText + '" />';
            }
            f = f + '</div><div class="tags_clear"></div></div>';
            c( f ).insertAfter( this );
            c( data.holder ).css( "width", e.width );
            c( data.holder ).css( "height", e.height );
            if ( c( data.real_input ).val() != "" ) {
                c.fn.tagsInput.importTags( c( data.real_input ), c( data.real_input ).val() );
            }
            if ( e.interactive ) {
                c( data.fake_input ).val( c( data.fake_input ).attr( "data-default" ) );
                c( data.fake_input ).css( "color", "#666666" );
                c( data.holder ).bind( "click", data, function ( g ) {
                    c( g.data.fake_input ).focus();
                } );
                c( data.fake_input ).bind( "focus", data, function ( g ) {
                    if ( c( g.data.fake_input ).val() == c( g.data.fake_input ).attr( "data-default" ) ) {
                        c( g.data.fake_input ).val( "" );
                    }
                    c( g.data.fake_input ).css( "color", "#000000" );
                } );
                if ( e.autocomplete_url != undefined ) {
                    c( data.fake_input ).autocomplete( e.autocomplete_url, e.autocomplete ).bind( "result", data, function ( g, j, h ) {
                        if ( j ) {
                            c( g.data.real_input ).addTag( h, {focus:true, unique:(e.unique)} );
                        }
                    } );
                    c( data.fake_input ).bind( "blur", data, function ( g ) {
                        if ( c( ".ac_results" ).is( ":visible" ) ) {
                            return false;
                        }
                        if ( c( g.data.fake_input ).val() != c( g.data.fake_input ).attr( "data-default" ) ) {
                            if ( (g.data.minChars <= c( g.data.fake_input ).val().length) && (!g.data.maxChars || (g.data.maxChars >= c( g.data.fake_input ).val().length)) ) {
                                c( g.data.real_input ).addTag( c( g.data.fake_input ).val(), {focus:false, unique:(e.unique)} );
                            }
                        }
                        c( g.data.fake_input ).val( c( g.data.fake_input ).attr( "data-default" ) );
                        c( g.data.fake_input ).css( "color", "#666666" );
                        return false;
                    } );
                } else {
                    c( data.fake_input ).bind( "blur", data, function ( g ) {
                        var h = c( this ).attr( "data-default" );
                        if ( c( g.data.fake_input ).val() != "" && c( g.data.fake_input ).val() != h ) {
                            if ( (g.data.minChars <= c( g.data.fake_input ).val().length) && (!g.data.maxChars || (g.data.maxChars >= c( g.data.fake_input ).val().length)) ) {
                                c( g.data.real_input ).addTag( c( g.data.fake_input ).val(), {focus:true, unique:(e.unique)} );
                            }
                        } else {
                            c( g.data.fake_input ).val( c( g.data.fake_input ).attr( "data-default" ) );
                            c( g.data.fake_input ).css( "color", "#666666" );
                        }
                        return false;
                    } );
                }
                c( data.fake_input ).bind( "keypress", data, function ( g ) {
                    if ( g.which == g.data.delimiter.charCodeAt( 0 ) || g.which == 13 ) {
                        if ( (g.data.minChars <= c( g.data.fake_input ).val().length) && (!g.data.maxChars || (g.data.maxChars >= c( g.data.fake_input ).val().length)) ) {
                            c( g.data.real_input ).addTag( c( g.data.fake_input ).val(), {focus:true, unique:(e.unique)} );
                        }
                        return false;
                    }
                } );
                data.removeWithBackspace && c( data.fake_input ).bind( "keyup", function ( h ) {
                    if ( h.keyCode == 8 && c( this ).val() == "" ) {
                        var g = c( this ).closest( ".tagsinput" ).find( ".tag:last" ).text();
                        var j = c( this ).attr( "id" ).replace( /_tag$/, "" );
                        g = g.replace( /[\s]+x$/, "" );
                        c( "#" + j ).removeTag( escape( g ) );
                        c( this ).trigger( "focus" );
                    }
                } );
                c( data.fake_input ).blur();
            }
            return false;
        } );
        return this;
    };
    c.fn.tagsInput.updateTagsField = function ( e, d ) {
        id = c( e ).attr( "id" );
        c( e ).val( d.join( a[id] ) );
    };
    c.fn.tagsInput.importTags = function ( g, h ) {
        c( g ).val( "" );
        id = c( g ).attr( "id" );
        var d = h.split( a[id] );
        for ( i = 0; i < d.length; i++ ) {
            c( g ).addTag( d[i], {focus:false, callback:false} );
        }
        if ( b[id] && b[id]["onChange"] ) {
            var e = b[id]["onChange"];
            e( g, d[i] );
        }
    };
})( jQuery );
