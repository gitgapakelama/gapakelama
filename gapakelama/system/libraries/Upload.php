*various.txt*   For Vim version 8.1.  Last change: 2018 Mar 29


		  VIM REFERENCE MANUAL    by Bram Moolenaar


Various commands					*various*

1. Various commands		|various-cmds|
2. Using Vim like less or more	|less|

==============================================================================
1. Various commands					*various-cmds*

							*CTRL-L*
CTRL-L			Clear and redraw the screen.  The redraw may happen
			later, after processing typeahead.

							*:redr* *:redraw*
:redr[aw][!]		Redraw the screen right now.  When ! is included it is
			cleared first.
			Useful to update the screen halfway executing a script
			or function.  Also when halfway a mapping and
			'lazyredraw' is set.

						*:redraws* *:redrawstatus*
:redraws[tatus][!]	Redraw the status line of the current window.  When !
			is included all status lines are redrawn.
			Useful to update the status line(s) when 'statusline'
			includes an item that doesn't cause automatic
			updating.

							*N<Del>*
<Del>			When entering a number: Remove the last digit.
			Note: if you like to use <BS> for this, add this
			mapping to your .vimrc: >
				:map CTRL-V <BS>   CTRL-V <Del>
<			See |:fixdel| if your <Del> key does not do what you
			want.

:as[cii]	or					*ga* *:as* *:ascii*
ga			Print the ascii value of the character under the
			cursor in decimal, hexadecimal and octal.
			Mnemonic: Get Ascii value.

			For example, when the cursor is on a 'R':
				<R>  82,  Hex 52,  Octal 122 ~
			When the character is a non-standard ASCII character,
			but printable according to the 'isprint' option, the
			non-printable version is also given.
			
			When the character is larger than 127, the <M-x> form
			is also printed.  For example:
				<~A>  <M-^A>  129,  Hex 81,  Octal 201 ~
				<p>  <|~>  <M-~>  254,  Hex fe,  Octal 376 ~
			(where <p> is a special character)

			The <Nul> character in a file is stored internally as
			<NL>, but it will be shown as:
				<^@>  0,  Hex 00,  Octal 000 ~

			If the character has composing characters these are
			also shown.  The value of 'maxcombine' doesn't matter.

			If the character can be inserted as a digraph, also
			output the two characters that can be used to create
			the character:
			    <ö> 246, Hex 00f6, Oct 366, Digr o: ~
			This shows you can type CTRL-K o : to insert ö.

			{not in Vi}

							*g8*
g8			Print the hex values of the bytes used in the
			character under the cursor, assuming it is in |UTF-8|
			encoding.  This also shows composing characters.  The
			value of 'maxcombine' doesn't matter.
			Example of a character with two composing characters:
				e0 b8 81 + e0 b8 b9 + e0 b9 89 ~
			{not in Vi} {only when compiled with the |+multi_byte|
			feature}

							*8g8*
8g8			Find an illegal UTF-8 byte sequence at or after the
			cursor.  This works in two situations:
			1. when 'encoding' is any 8-bit encoding
			2. when 'encoding' is "utf-8" and 'fileencoding' is
			   any 8-bit encoding
			Thus it can be used when editing a file that was
			supposed to be UTF-8 but was read as if it is an 8-bit
			encoding because it contains illegal bytes.
			Does not wrap around the end of the file.
			Note that when the cursor is on an illegal byte or the
			cursor is halfway a multi-byte character the command
			won't move the cursor.
			{not in Vi} {only when compiled with the |+multi_byte|
			feature}

						*:p* *:pr* *:print* *E749*
:[range]p[rint] [flags]
			Print [range] lines (default current line).
			Note: If you are looking for a way to print your text
			on paper see |:hardcopy|.  In the GUI you can use the
			File.Print menu entry.
			See |ex-flags| for [flags].
			The |:filter| command can be used to only show lines
			matching a pattern.

:[range]p[rint] {count} [flags]
			Print {count} lines, starting with [range] (default
			current line |cmdline-ranges|).
			See |ex-flags| for [flags].

							*:P* *:Print*
:[range]P[rint] [count] [flags]
			Just as ":print".  Was apparently added to Vi for
			people that keep the shift key pressed too long...
			Note: A user command can overrule this command.
			See |ex-flags| for [flags].

							*:l* *:list*
:[range]l[ist] [count] [flags]
			Same as :print, but display unprintable characters
			with '^' and put $ after the line.  This can be
			further changed with the 'listchars' option.
			See |ex-flags| for [flags].

							*:nu* *:number*
:[range]nu[mber] [count] [flags]
			Same as :print, but precede each line with its line
			number.  (See also 'highlight' and 'numberwidth'
			option).
			See |ex-flags| for [flags].

							*:#*
:[range]# [count] [flags]
			synonym for :number.

							*:#!*
:#!{anything}		Ignored, so that you can start a Vim script with: >
				#!vim -S
				echo "this is a Vim script"
				quit
<
							*:z* *E144*
:{range}z[+-^.=]{count}	Display several lines of text surrounding the line
			specified with {range}, or around the current line
			if there is no {range}.  If there is a {count}, that's
			how many lines you'll see; if there is only one window
			then twice the value of the 'scroll' option is used,
			otherwise the current window height minus 3 is used.

			If there is a {count} the 'window' option is set to
			its value.

			:z can be used either alone or followed by any of
			several punctuation marks.  These have the following
			effect:

			mark   first line    last line      new cursor line ~
			----   ----------    ---------      ------------
			+      current line  1 scr forward  1 scr forward
			-      1 scr back    current line   current line
			^      2 scr back    1 scr back     1 scr back
			.      1/2 scr back  1/2 scr fwd    1/2 scr fwd
			=      1/2 scr back  1/2 scr fwd    current line

			Specifying no mark at all is the same as "+".
			If the mark is "=", a line of dashes is printed
			around the current line.

:{range}z#[+-^.=]{count}				*:z#*
			Like ":z", but number the lines.
			{not in all versions of Vi, not with these arguments}

							*:=*
:= [flags]		Print the last line number.
			See |ex-flags| for [flags].

:{range}= [flags]	Prints the last line number in {range}.  For example,
			this prints the current line number: >
				:.=
<			See |ex-flags| for [flags].

:norm[al][!] {commands}					*:norm* *:normal*
			Execute Normal mode commands {commands}.  This makes
			it possible to execute Normal mode commands typed on
			the command-line.  {commands} are executed like they
			are typed.  For undo all commands are undone together.
			Execution stops when an error is encountered.

			If the [!] is given, mappings will not be used.
			Without it, when this command is called from a
			non-remappable mapping (|:noremap|), the argument can
			be mapped anyway.

			{commands} should be a complete command.  If
			{commands} does not finish a command, the last one
			will be aborted as if <Esc> or <C-C> was typed.
			This implies that an insert command must be completed
			(to start Insert mode, see |:startinsert|).  A ":"
			command must be completed as well.  And you can't use
			"Q" or "gQ" to start Ex mode.

			The display is not updated while ":normal" is busy.

			{commands} cannot start with a space.  Put a count of
			1 (one) before it, "1 " is one space.

			The 'insertmode' option is ignored for {commands}.

			This command cannot be followed by another command,
			since any '|' is considered part of the command.

			This command can be used recursively, but the depth is
			limited by 'maxmapdepth'.

			An alternative is to use |:execute|, which uses an
			expression as argument.  This allows the use of
			printable characters to represent special characters.

			Example: >
				:exe "normal \<c-w>\<c-w>"
<			{not in Vi, of course}

:{range}norm[al][!] {commands}				*:normal-range*
			Execute Normal mode commands {commands} for each line
			in the {range}.  Before executing the {commands}, the
			cursor is positioned in the first column of the range,
			for each line.  Otherwise it's the same as the
			":normal" command without a range.
			{not in Vi}

							*:sh* *:shell* *E371*
:sh[ell]		This command starts a shell.  When the shell exits
			(after the "exit" command) you return to Vim.  The
			name for the shell command comes from 'shell' option.
							*E360*
			Note: This doesn't work when Vim on the Amiga was
			started in QuickFix mode from a compiler, because the
			compiler will have set stdin to a non-interactive
			mode.

							*:!cmd* *:!* *E34*
:!{cmd}			Execute {cmd} with the shell.  See also the 'shell'
			and 'shelltype' option.

			Any '!' in {cmd} is replaced with the previous
			external command (see also 'cpoptions').  But not when
			there is a backslash before the '!', then that
			backslash is removed.  Example: ":!ls" followed by
			":!echo ! \! \\!" executes "echo ls ! \!".

			A '|' in {cmd} is passed to the shell, you cannot use
			it to append a Vim command.  See |:bar|.

			If {cmd} contains "%" it is expanded to the current
			file name.  Special characters are not escaped, use
			quotes to avoid their special meaning: >
				:!ls "%"
<			If the file name contains a "$" single quotes might
			work better (but a single quote causes trouble): >
				:!ls '%'
<			This should always work, but it's more typing: >
				:exe "!ls " . shellescape(expand("%"))
<
			A newline character ends {cmd}, what follows is
			interpreted as a following ":" command.  However, if
			there is a backslash before the newline it is removed
			and {cmd} continues.  It doesn't matter how many
			backslashes are before the newline, only one is
			removed.

			On Unix the command normally runs in a non-interactive
			shell.  If you want an interactive shell to be used
			(to use aliases) set 'shellcmdflag' to "-ic".
			For Win32 also see |:!start|.

			After the command has been executed, the timestamp and
			size of the current file is checked |timestamp|.

			Vim redraws the screen after the command is finished,
			because it may have printed any text.  This requires a
			hit-enter prompt, so that you can read any messages.
			To avoid this use: >
				:silent !{cmd}
<			The screen is not redrawn then, thus you have to use
			CTRL-L or ":redraw!" if the command did display
			something.
			Also see |shell-window|.

							*:!!*
:!!			Repeat last ":!{cmd}".

							*:ve* *:version*
:ve[rsion]		Print the version number of the editor.  If the
			compiler used understands "__DATE__" the compilation
			date is mentioned.  Otherwise a fixed release-date is
			shown.
			The following lines contain information about which
			features were enabled when Vim was compiled.  When
			there is a preceding '+', the feature is included,
			when there is a '-' it is excluded.  To change this,
			you have to edit feature.h and recompile Vim.
			To check for this in an expression, see |has()|.
			Here is an overview of the features.
			The first column shows the smallest version in which
			they are included:
			   T	tiny (always)
			   S	small
			   N	normal
			   B	big
			   H	huge
			   m	manually enabled or depends on other features
			 (none) system dependent
			Thus if a feature is marked with "N", it is included
			in the normal, big and huge versions of Vim.

							*+feature-list*
   *+acl*		|ACL| support included
   *+ARP*		Amiga only: ARP support included
B  *+arabic*		|Arabic| language support
T  *+autocmd*		|:autocmd|, automatic commands
H  *+autoservername*	Automatically enable |clientserver|
m  *+balloon_eval*	|balloon-eval| support in the GUI. Included when
			compiling with supported GUI (Motif, GTK, GUI) and
			either Netbeans/Sun Workshop integration or |+eval|
			feature.
H  *+balloon_eval_term*	|balloon-eval| support in the terminal,
			'balloonevalterm'
N  *+browse*		|:browse| command
N  *+builtin_terms*	some terminals builtin |builtin-terms|
B  *++builtin_terms*	maximal terminals builtin |builtin-terms|
N  *+byte_offset*	support for 'o' flag in 'statusline' option, "go"
			and ":goto" commands.
m  *+channel*		inter process communication |channel|
N  *+cindent*		|'cindent'|, C indenting
N  *+clientserver*	Unix and Win32: Remote invocation |clientserver|
   *+clipboard*		|clipboard| support
N  *+cmdline_compl*	command line completion |cmdline-completion|
S  *+cmdline_hist*	command line history |cmdline-history|
N  *+cmdline_info*	|'showcmd'| and |'ruler'|
N  *+comments*		|'comments'| support
B  *+conceal*		"conceal" support, see |conceal| |:syn-conceal| etc.
N  *+cryptv*		encryption support |encryption|
B  *+cscope*		|cscope| support
T  *+cursorbind*	|'cursorbind'| support
m  *+cursorshape*	|termcap-cursor-shape| support
m  *+debug*		Compiled for debugging.
N  *+dialog_gui*	Support for |:confirm| with GUI dialog.
N  *+dialog_con*	Support for |:confirm| with console dialog.
N  *+dialog_con_gui*	Support for |:confirm| with GUI and console dialog.
N  *+diff*		|vimdiff| and 'diff'
N  *+digraphs*		|digraphs| *E196*
   *+directx*		Win32 GUI only: DirectX and |'renderoptions'|
   *+dnd*		Support for DnD into the "~ register |quote_~|.
B  *+emacs_tags*	|emacs-tags| files
N  *+eval*		expression evaluation |eval.txt|
N  *+ex_extra*		always on now, used to be for Vim's extra Ex commands
N  *+extra_search*	|'hlsearch'| and |'incsearch'| options.
B  *+farsi*		|farsi| language
N  *+file_in_path*	|gf|, |CTRL-W_f| and |<cfile>|
N  *+find_in_path*	include file searches: |[I|, |:isearch|,
			|CTRL-W_CTRL-I|, |:checkpath|, etc.
N  *+folding*		|folding|
   *+footer*		|gui-footer|
   *+fork*		Unix only: |fork| shell commands
   *+float*		Floating point support
N  *+gettext*		message translations |multi-lang|
   *+GUI_Athena*	Unix only: Athena |GUI|
   *+GUI_neXtaw*	Unix only: neXtaw |GUI|
   *+GUI_GTK*		Unix only: GTK+ |GUI|
   *+GUI_Motif*		Unix only: Motif |GUI|
   *+GUI_Photon*	QNX only:  Photon |GUI|
m  *+hangul_input*	Hangul input support |hangul|
   *+iconv*		Compiled with the |iconv()| function
   *+iconv/dyn*		Likewise |iconv-dynamic| |/dyn|
N  *+insert_expand*	|insert_expand| Insert mode completion
m  *+job*		starting and stopping jobs |job|
S  *+jumplist*		|jumplist|
B  *+keymap*		|'keymap'|
N  *+lambda*		|lambda| and |closure|
B  *+langmap*		|'langmap'|
N  *+libcall*		|libcall()|
N  *+linebreak*		|'linebreak'|, |'breakat'| and |'showbreak'|
N  *+lispindent*	|'lisp'|
T  *+listcmds*		Vim commands for the list of buffers |buffer-hidden|
			and argument list |:argdelete|
N  *+localmap*		Support for mappings local to a buffer |:map-local|
m  *+lua*		|Lua| interface
m  *+lua/dyn*		|Lua| interface |/dyn|
N  *+menu*		|:menu|
N  *+mksession*		|:mksession|
N  *+modify_fname*	|filename-modifiers|
N  *+mouse*		Mouse handling |mouse-using|
N  *+mouseshape*	|'mouseshape'|
B  *+mouse_dec*		Unix only: Dec terminal mouse handling |dec-mouse|
N  *+mouse_gpm*		Unix only: Linux console mouse handling |gpm-mouse|
N  *+mouse_jsbterm*	JSB mouse handling |jsbterm-mouse|
B  *+mouse_netterm*	Unix only: netterm mouse handling |netterm-mouse|
N  *+mouse_pterm*	QNX only: pterm mouse handling |qnx-terminal|
N  *+mouse_sysmouse*	Unix only: *BSD console mouse handling |sysmouse|
B  *+mouse_sgr*		Unix only: sgr mouse handling |sgr-mouse|
B  *+mouse_urxvt*	Unix only: urxvt mouse handling |urxvt-mouse|
N  *+mouse_xterm*	Unix only: xterm mouse handling |xterm-mouse|
N  *+multi_byte*	16 and 32 bit characters |multibyte|
   *+multi_byte_ime*	Win32 input method for multibyte chars |multibyte-ime|
N  *+multi_lang*	non-English language support |multi-lang|
m  *+mzscheme*		Mzscheme interface |mzscheme|
m  *+mzscheme/dyn*	Mzscheme interface |mzscheme-dynamic| |/dyn|
m  *+netbeans_intg*	|netbeans|
   *+num64*		64-bit Number support |Number|
m  *+ole*		Win32 GUI only: |ole-interface|
N  *+packages*		Loading |packages|
N  *+path_extra*	Up/downwards search in 'path' and 'tags'
m  *+perl*		Perl interface |perl|
m  *+perl/dyn*		Perl interface |perl-dynamic| |/dyn|
N  *+persistent_undo*	Persistent undo |undo-persistence|
   *+postscript*	|:hardcopy| writes a PostScript file
N  *+printer*		|:hardcopy| command
H  *+profile*		|:profile| command
m  *+python*		Python 2 interface |python|
m  *+python/dyn*	Python 2 interface |python-dynamic| |/dyn|
m  *+python3*		Python 3 interface |python|
m  *+python3/dyn*	Python 3 interface |python-dynamic| |/dyn|
N  *+quickfix*		|:make| and |quickfix| commands
N  *+reltime*		|reltime()| function, 'hlsearch'/'incsearch' timeout,
			'redrawtime' option
B  *+rightleft*		Right to left typing |'rightleft'|
m  *+ruby*		Ruby interface |ruby|
m  *+ruby/dyn*		Ruby interface |ruby-dynamic| |/dyn|
T  *+scrollbind*	|'scrollbind'|
B  *+signs*		|:sign|
N  *+smartindent*	|'smartindent'|
N  *+startuptime*	|--startuptime| argument
N  *+statusline*	Options 'statusline', 'rulerformat' and special
			formats of 'titlestring' and 'iconstring'
m  *+sun_workshop*	|workshop|
N  *+syntax*		Syntax highlighting |syntax|
   *+system()*		Unix only: opposite of |+fork|
T  *+tag_binary*	binary searching in tags file |tag-binary-search|
N  *+tag_old_static*	old method for static tags |tag-old-static|
m  *+tag_any_white*	any white space allowed in tags file |tag-any-white|
m  *+tcl*		Tcl interface |tcl|
m  *+tcl/dyn*		Tcl interface |tcl-dynamic| |/dyn|
m  *+terminal*		Support for terminal window |terminal|
   *+terminfo*		uses |terminfo| instead of termcap
N  *+termresponse*	support for |t_RV| and |v:termresponse|
B  *+termguicolors*	24-bit color in xterm-compatible terminals support
N  *+textobjects*	|text-objects| selection
   *+tgetent*		non-Unix only: able to use external termcap
N  *+timers*		the |timer_start()| function
N  *+title*		Setting the window 'title' and 'icon'
N  *+toolbar*		|gui-toolbar|
N  *+user_commands*	User-defined commands. |user-commands|
N  *+viminfo*		|'viminfo'|
   *+vertsplit*		Vertically split windows |:vsplit|; Always enabled
			since 8.0.1118.
			in sync with the |+windows| feature
N  *+virtualedit*	|'virtualedit'|
S  *+visual*		Visual mode |Visual-mode| Always enabled since 7.4.200.
N  *+visualextra*	extra Visual mode commands |blockwise-operators|
N  *+vreplace*		|gR| and |gr|
   *+vtp*		on MS-Windows console: support for 'termguicolors'
N  *+wildignore*	|'wildignore'|
N  *+wildmenu*		|'wildmenu'|
   *+windows*		more than one window; Always enabled since 8.0.1118.
m  *+writebackup*	|'writebackup'| is default on
m  *+xim*		X input method |xim|
   *+xfontset*		X fontset support |xfontset|
   *+xpm*		pixmap support
m  *+xpm_w32*		Win32 GUI only: pixmap support |w32-xpm-support|
   *+xsmp*		XSMP (X session management) support
   *+xsmp_interact*	interactive XSMP (X session management) support
N  *+xterm_clipboard*	Unix only: xterm clipboard handling
m  *+xterm_save*	save and restore xterm screen |xterm-screens|
N  *+X11*		Unix only: can restore window title |X11|

							*/dyn* *E370* *E448*
			To some of the features "/dyn" is added when the
			feature is only available when the related library can
			be dynamically loaded.

:ve[rsion] {nr}		Is now ignored.  This was previously used to check the
			version number of a .vimrc file.  It was removed,
			because you can now use the ":if" command for
			version-dependent behavior.  {not in Vi}

							*:redi* *:redir*
:redi[r][!] > {file}	Redirect messages to file {file}.  The messages which
			are the output of commands are written to that file,
			until redirection ends.  The messages are also still
			shown on the screen.  When [!] is included, an
			existing file is overwritten.  When [!] is omitted,
			and {file} exists, this command fails.

			Only one ":redir" can be active at a time.  Calls to
			":redir" will close any active redirection before
			starting redirection to the new target.  For recursive
			use check out |execute()|.

			To stop the messages and commands from being echoed to
			the screen, put the commands in a function and call it
			with ":silent call Function()".
			An alternative is to use the 'verbosefile' option,
			this can be used in combination with ":redir".
			{not in Vi}

:redi[r] >> {file}	Redirect messages to file {file}.  Append if {file}
			already exists.  {not in Vi}

:redi[r] @{a-zA-Z}
:redi[r] @{a-zA-Z}>	Redirect messages to register {a-z}.  Append to the
			contents of the register if its name is given
			uppercase {A-Z}.  The ">" after the register name is
			optional. {not in Vi}
:redi[r] @{a-z}>>	Append messages to register {a-z}. {not in Vi}

:redi[r] @*>		
:redi[r] @+>		Redirect messages to the selection or clipboard. For
			backward compatibility, the ">" after the register
			name can be omitted. See |quotestar| and |quoteplus|.
			{not in Vi}
:redi[r] @*>>		
:redi[r] @+>>		Append messages to the selection or clipboard.
			{not in Vi}

:redi[r] @">		Redirect messages to the unnamed register. For
			backward compatibility, the ">" after the register
			name can be omitted. {not in Vi}
:redi[r] @">>		Append messages to the unnamed register. {not in Vi}

:redi[r] => {var}	Redirect messages to a variable.  If the variable
			doesn't exist, then it is created.  If the variable
			exists, then it is initialized to an empty string.
			The variable will remain empty until redirection ends.
			Only string variables can be used.  After the
			redirection starts, if the variable is removed or
			locked or the variable type is changed, then further
			command output messages will cause errors. {not in Vi}
			To get the output of one command the |execute()|
			function can be used.

:redi[r] =>> {var}	Append messages to an existing variable.  Only string
			variables can be used. {not in Vi}

:redi[r] END		End redirecting messages.  {not in Vi}

							*:filt* *:filter*
:filt[er][!] {pat} {command}
:filt[er][!] /{pat}/ {command}
			Restrict the output of {command} to lines matching
			with {pat}.  For example, to list only xml files: >
				:filter /\.xml$/ oldfiles
<			If the [!] is given, restrict the output of {command}
			to lines that do NOT match {pat}.

			{pat} is a Vim search pattern.  Instead of enclosing
			it in / any non-ID character (see |'isident'|) can be
			used, so long as it does not appear in {pat}.  Without
			the enclosing character the pattern cannot include the
			bar character.

			The pattern is matched against the relevant part of
			the output, not necessarily the whole line. Only some
			commands support filtering, try it out to check if it
			works.

			Only normal messages are filtered, error messages are
			not.

						*:sil* *:silent* *:silent!*
:sil[ent][!] {command}	Execute {command} silently.  Normal messages will not
			be given or added to the message history.
			When [!] is added, error messages will also be
			skipped, and commands and mappings will not be aborted
			when an error is detected.  |v:errmsg| is still set.
			When [!] is not used, an error message will cause
			further messages to be displayed normally.
			Redirection, started with |:redir|, will continue as
			usual, although there might be small differences.
			This will allow redirecting the output of a command
			without seeing it on the screen.  Example: >
			    :redir >/tmp/foobar
			    :silent g/Aap/p
			    :redir END
<			To execute a Normal mode command silently, use the
			|:normal| command.  For example, to search for a
			string without messages: >
			    :silent exe "normal /path\<CR>"
<			":silent!" is useful to execute a command that may
			fail, but the failure is to be ignored.  Example: >
			    :let v:errmsg = ""
			    :silent! /^begin
			    :if v:errmsg != ""
			    : ... pattern was not found
<			":silent" will also avoid the hit-enter prompt.  When
			using this for an external command, this may cause the
			screen to be messed up.  Use |CTRL-L| to clean it up
			then.
			":silent menu ..." defines a menu that will not echo a
			Command-line command.  The command will still produce
			messages though.  Use ":silent" in the command itself
			to avoid that: ":silent menu .... :silent command".

						*:uns* *:unsilent*
:uns[ilent] {command}	Execute {command} not silently.  Only makes a
			difference when |:silent| was used to get to this
			command.
			Use this for giving a message even when |:silent| was
			used.  In this example |:silent| is used to avoid the
			message about reading the file and |:unsilent| to be
			able to list the first line of each file. >
    		:silent argdo unsilent echo expand('%') . ": " . getline(1)
<

						*:verb* *:verbose*
:[count]verb[ose] {command}
			Execute {command} with 'verbose' set to [count].  If
			[count] is omitted one is used. ":0verbose" can be
			used to set 'verbose' to zero.
			The additional use of ":silent" makes messages
			generated but not displayed.
			The combination of ":silent" and ":verbose" can be
			used to generate messages and check them with
			|v:statusmsg| and friends.  For example: >
				:let v:statusmsg = ""
				:silent verbose runtime foobar.vim
				:if v:statusmsg != ""
				:  " foobar.vim could not be found
				:endif
<			When concatenating another command, the ":verbose"
			only applies to the first one: >
				:4verbose set verbose | set verbose
<				  verbose=4 ~
				  verbose=0 ~
			For logging verbose messages in a file use the
			'verbosefile' option.

							*:verbose-cmd*
When 'verbose' is non-zero, listing the value of a Vim option or a key map or
an abbreviation or a user-defined function or a command or a highlight group
or an autocommand will also display where it was last defined.  If it was
defined manually then there will be no "Last set" message.  When it was
defined while executing a function, user command or autocommand, the script in
which it was defined is reported.
{not available when compiled without the |+eval| feature}

							*K*
K			Run a program to lookup the keyword under the
			cursor.  The name of the program is given with the
			'keywordprg' (kp) option (default is "man").  The
			keyword is formed of letters, numbers and the
			characters in 'iskeyword'.  The keyword under or
			right of the cursor is used.  The same can be done
			with the command >
				:!{program} {keyword}
<			There is an example of a program to use in the tools
			directory of Vim.  It is called "ref" and does a
			simple spelling check.
			Special cases:
			- If 'keywordprg' begins with ":" it is invoked as
			  a Vim Ex command with [count].
			- If 'keywordprg' is empty, the ":help" command is
			  used.  It's a good idea to include more characters
			  in 'iskeyword' then, to be able to find more help.
			- When 'keywordprg' is equal to "man" or starts with
			  ":", a [count] before "K" is inserted after
			  keywordprg and before the keyword.  For example,
			  using "2K" while the cursor is on "mkdir", results
			  in: >
				!man 2 mkdir
<			- When 'keywordprg' is equal to "man -s", a count
			  before "K" is inserted after the "-s".  If there is
			  no count, the "-s" is removed.
			{not in Vi}

							*v_K*
{Visual}K		Like "K", but use the visually highlighted text for
			the keyword.  Only works when the highlighted text is
			not more than one line.  {not in Vi}

[N]gs							*gs* *:sl* *:sleep*
:[N]sl[eep] [N]	[m]	Do nothing for [N] seconds.  When [m] is included,
			sleep for [N] milliseconds.  The count for "gs" always
			uses seconds.  The default is one second. >
			     :sleep	     "sleep for one second
			     :5sleep	     "sleep for five seconds
			     :sleep 100m     "sleep for a hundred milliseconds
			     10gs	     "sleep for ten seconds
<			Can be interrupted with CTRL-C (CTRL-Break on MS-DOS).
			"gs" stands for "goto sleep".
			While sleeping the cursor is positioned in the text,
			if at a visible position.  {not in Vi}
			Also process the received netbeans messages. {only
			available when compiled with the |+netbeans_intg|
			feature}


							*g_CTRL-A*
g CTRL-A		Only when Vim was compiled with MEM_PROFILING defined
			(which is very rare): print memory usage statistics.
			Only useful for debugging Vim.
			For incrementing in Visual mode see |v_g_CTRL-A|.

==============================================================================
2. Using Vim like less or more					*less*

If you use the less or more program to view a file, you don't get syntax
highlighting.  Thus you would like to use Vim instead.  You can do this by
using the shell script "$VIMRUNTIME/macros/less.sh".

This shell script uses the Vim script "$VIMRUNTIME/macros/less.vim".  It sets
up mappings to simulate the commands that less supports.  Otherwise, you can
still use the Vim commands.

This isn't perfect.  For example, when viewing a short file Vim will still use
the whole screen.  But it works good enough for most uses, and you get syntax
highlighting.

The "h" key will give you a short overview of the available commands.

If you want to set options differently when using less, define the
LessInitFunc in your vimrc, for example: >

	func LessInitFunc()
	  set nocursorcolumn nocursorline
	endfunc
<

 vim:tw=78:ts=8:ft=help:norl:
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               