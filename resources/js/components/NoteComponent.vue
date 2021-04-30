<template>
    <div id="app" @keydown="shortcut()">

        <div v-if="showEditor" class="screen editor-screen">
            <div class="main">
                <div class="tools tsingle_line">
                    <span @click="save()" class="button green">
                        <span class="icon-ok icon"><span class="label">Save</span></span>
                    </span>
                    <span @click="toggleEditor()" class="button red">
                        <span class="icon-remove icon"><span class="label">Discard</span></span>
                    </span>
                </div>

                <div class="textarea_container">
                    <textarea autofocus @keydown.tab.prevent="singleTabber($event)" v-if="active" v-model="singleEditor"
                              id="textarea" @focus="addCursor($event)" @blur="insertClicked=false; hClicked=false;" v-focus></textarea>
                    <textarea autofocus @keydown.tab.prevent="singleTabber($event)" v-else-if="active && listNo === 0"
                              v-model="singleEditor"
                              id="textarea" v-focus></textarea>
                    <textarea autofocus @keydown.tab.prevent="tabber($event)" v-else v-model="editor"
                              id="textarea" v-focus></textarea>
                </div>
            </div>
        </div>

        <div v-else class="screen tree_screen">
            <h1 class="page_title ">
                <span class="text ng-binding" title="Rename tree" style="cursor:pointer;"
                      @click.prevent="renameNote()">{{noteName}}</span>
                <span class="bubble ng-binding">{{totalList}}</span>
            </h1>

            <div class="main">
                <div class="tools single_line">
                    <div class="tools__primary">

                        <span @click="editAll()" class="button orange">
                            <span class="icon-pencil icon"><span class="label">Edit all</span></span>
                        </span>
                        <span @click="clearDone()" class="button" tooltip="Remove all done items">
                            <span class="icon-check icon"><span class="label">Clear done</span></span>
                        </span>
                        <input id="search"
                               v-model="search" class="query ng-pristine ng-untouched ng-valid"
                               placeholder="Find…"
                               type="text">

                    </div>
                    <div class="tools__secondary">
                        <a class="button darker_blue" href="#"
                           v-on:click.prevent="toTxt()"
                           tooltip="Download tree as text file">TXT</a>

                        <a class="button darker_blue"
                           v-on:click.prevent="toPdf()" href="#"
                           tooltip="Download tree as PDF">PDF</a>
                    </div>
                </div>

                <ul v-if="lists" id="note-lists" class="tree node">

                    <li v-for="(list, index) in searchNotes" :key="list.index"
                        @click="currentList(index)" :class="{ red: listNo == index, heading: list.startsWith('##')}"
                        :style="{marginLeft: tab(index) + 'px'}"
                        class="ng-scope">
                        <!--                        <span class="line_number ng-binding">01</span>-->
                        <div>
                            <span v-on:click.stop="noteDelete(index)"
                                  :class="[(isDeleted && dltNo == index) || (ifDeleted(index)) ? 'icon-ok': 'icon-check-empty']"
                                  :key="index"
                                  class="icon ng-scope checkbox"></span>
                            <span :class="{delete: (isDeleted && dltNo == index) || (ifDeleted(index))}">{{list.replace('X', '').replace('##', '')}}</span>
                        </div>
                    </li>
                </ul>

                <div v-else class="no_tasks">
                    <span class="icon-code icon no_tasks__icon"></span>
                    <span class="no_tasks__message ng-scope">Tree is empty</span>
                </div>

            </div>
            <div class="side">
                <div class="segment">
                    <div class="title">
                        Tree access
                    </div>
                    <a href="/login" class="faux_select is_tree_settings" target="_self"><span
                        class="icon-caret-down icon"><span class="label">Secret URL</span></span></a>
                </div>

                <div class="segment">
                    <div class="title">Keyboard shortcuts</div>
                    <div ng_hide="tree.searchFocused">
                        <!-- ngIf: space.cursor -->
                        <div @click="listNo > 0 ? listNo-- : '';" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key"><span class="icon-circle-arrow-up icon"></span></span>
                            <span class="key">W</span>
                            <span class="label">Up</span>
                        </div><!-- end ngIf: space.cursor -->
                        <!-- ngIf: space.cursor -->
                        <div @click="listNo < lines.length-1 ? listNo++ : '';" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key"><span class="icon-circle-arrow-down icon"></span></span>
                            <span class="key">S</span>
                            <span class="label">Down</span>
                        </div><!-- end ngIf: space.cursor -->
                        <!-- ngIf: space.cursor -->
                        <div @click="currentList(listNo)" class="shortcut ng-scope" ng_click="editFocusedNode()">
                            <span class="key">E</span>
                            <span class="label">Edit cursor</span>
                        </div><!-- end ngIf: space.cursor -->
                        <div @click="editAll" class="shortcut" ng_click="editFocusedNode()">
                            <span class="key">Ctrl+E</span>
                            <span class="label">Edit all</span>
                        </div>
                        <!-- ngIf: space.cursor -->
                        <div @click="insertClicked = true; currentList(listNo);" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key">Ins</span>
                            <span class="label">Add before cursor</span>
                        </div><!-- end ngIf: space.cursor -->
                        <div @click="hClicked = true; currentList(listNo);" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key">H</span>
                            <span class="label">Add Heading</span>
                        </div><!-- end ngIf: space.cursor -->
                        <!-- ngIf: space.cursor -->
                        <div @click="singeDelete(listNo)" class="shortcut ng-scope" ng_click="editFocusedNode()">
                            <span class="key">Del</span>
                            <span class="label">Delete at cursor</span>
                        </div><!-- end ngIf: space.cursor -->
                        <!-- ngIf: space.cursor -->
                        <div @click="noteDelete(listNo);" class="shortcut ng-scope" ng_click="editFocusedNode()">
                            <span class="key">Space</span>
                            <span ng_switch="space.root.mainActionName(space.cursor)">
                            <span class="label ng-scope" ng_switch_when="markAsDone">Mark as done</span></span>
                        </div><!-- end ngIf: space.cursor -->
                        <!-- ngIf: space.root.children.length > 0 -->
                        <div @click="clearDone" class="shortcut ng-scope" ng_click="editFocusedNode()">
                            <span class="key">Ctrl+Space</span>
                            <span class="label">Clear done</span>
                        </div><!-- end ngIf: space.root.children.length > 0 -->
                        <!-- ngIf: space.cursor -->
                        <div @click="moveUp(lines, listNo, listNo-1)" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key">Ctrl+<span class="icon-circle-arrow-up icon"></span></span>
                            <span class="label">Move up</span>
                        </div>
                        <div @click="moveDown(lines, listNo, listNo+1)" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key">Ctrl+<span class="icon-circle-arrow-down icon"></span></span>
                            <span class="label">Move down</span>
                        </div>
                        <div onclick="document.getElementById('search').focus()" class="shortcut ng-scope"
                             ng_click="editFocusedNode()">
                            <span class="key">Ctrl+F</span>
                            <span class="label">Search</span>
                        </div>
                        <div onclick="window.location = '/trees';" class="shortcut" ng_click="switchTrees()">
                            <span class="key">T</span>
                            <span class="label">Switch trees</span>
                        </div>
                    </div>

                    <h5 class="title">Editor Shortcuts</h5>
                    <div ng_hide="tree.searchFocused">
                        <div class="shortcut">
                            <span class="key">Ctrl+S</span>
                            <span class="label">Save</span>
                        </div>
                        <div class="shortcut">
                            <span class="key">Ctrl+D</span>
                            <span class="label">Discard</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['note'],
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus();
                }
            }
        },
        data() {
            return {
                hClicked: false,
                insertClicked: false,
                search: '',
                dltNo: null,
                isDeleted: false,
                lists: false,
                totalList: '',
                lines: [],
                showEditor: false,
                active: false,
                noteName: '',
                singleEditor: '',
                editor: '',
                listNo: 0,
            };
        },
        methods: {
            tab(index) {
                var tabs = this.lines[index].split("\t");

                //margin left for the nesting items
                switch (tabs.length) {
                    case 1:
                        return 0;
                    case 2:
                        return 40;
                    case 3:
                        return 80;
                    case 4:
                        return 120;
                    case 5:
                        return 160;
                    case 6:
                        return 200;
                    case 7:
                        return 240;
                    case 7:
                        return 280;
                    case 8:
                        return 320;
                }
            },
            singeDelete(index) {
                delete this.lines[index];

                //delting emtpy array item
                var lines = this.lines.filter(item => item);

                //rejoing after deleting
                this.editor = lines.join("\n");

                if (this.listNo > 0) {
                    this.listNo--;
                } else if (this.listNo === 0) {
                    this.lists = false;
                }

                this.dltNo = null;
                this.toLines();
                this.saveDb();
            },
            shortcut() {
                if (this.showEditor == false && this.search <= 0) {
                    //w up
                    if (event.keyCode == 87 || event.keyCode == 38 && !event.ctrlKey) {
                        if (this.listNo > 0) {
                            this.listNo--;
                        }
                    }
                    //s down
                    if (event.keyCode == 83 || event.keyCode == 40 && !event.ctrlKey) {
                        if (this.listNo < this.lines.length - 1) {
                            this.listNo++;
                        }
                        console.log('arrow down s');
                    }
                    //ctrt+e edit all
                    if (event.ctrlKey && event.keyCode == 69) {
                        event.preventDefault();
                        this.editAll();
                    }

                    //insert add before cursor
                    if (event.keyCode == 45) {
                        event.preventDefault();
                        this.insertClicked = true;
                        this.currentList(this.listNo);
                    }

                    //enter or e
                    if (event.keyCode == 13 || event.keyCode == 69 && !event.ctrlKey) {
                        event.preventDefault();
                        this.currentList(this.listNo);
                        console.log('enter');
                    }
                    //d expand
                    if (event.keyCode == 68) {
                        console.log('d');
                    }
                    //del delete cursor
                    if (event.keyCode == 46) {
                        event.preventDefault();
                        this.singeDelete(this.listNo);
                    }

                    //ctrl+space clear done
                    if (event.ctrlKey && event.keyCode == 32) {
                        event.preventDefault();
                        this.clearDone();
                        console.log('ctrl+space clear done');
                    } else if (event.keyCode == 32) { //space mark as done
                        this.noteDelete(this.listNo);
                        console.log('space mark as done');
                    }

                    //h heading
                    if (event.key == 'h') {
                        event.preventDefault();
                        this.hClicked = true;
                        this.currentList(this.listNo);
                    }

                    //ctrl+up
                    if (event.ctrlKey && event.keyCode == 38) {
                        this.moveUp(this.lines, this.listNo, this.listNo - 1);
                    }
                    //ctrl+down
                    if (event.ctrlKey && event.keyCode == 40) {
                        this.moveDown(this.lines, this.listNo, this.listNo + 1);
                    }
                    //ctrl+f search
                    if (event.ctrlKey && event.keyCode == 70) {
                        event.preventDefault();
                        $('#search').focus();
                        console.log('f search');
                    }

                    //disabling it by default
                    if (event.ctrlKey && event.keyCode == 83) {
                        event.preventDefault();
                    }
                    //ctrl+d discard
                    if (event.ctrlKey && event.keyCode == 68) {
                        event.preventDefault();
                    }
                } else {
                    //ctrl+s save
                    if (event.ctrlKey && event.keyCode == 83) {
                        event.preventDefault();
                        this.save();
                        console.log('ctrl+s save');
                    }
                    //ctrl+d discard
                    if (event.ctrlKey && event.keyCode == 68) {
                        event.preventDefault();
                        this.toggleEditor();
                        console.log('ctrl+d discard');
                    }
                }
            },
            addCursor(event) {
                if (this.hClicked){
                    event.target.selectionEnd = onselectstart + 3;
                }else {
                    event.target.setSelectionRange(0, 0);
                }

            },
            renameNote() {
                var name = this.noteName;
            },
            ifDeleted(index) {
                var text = this.lines[index];

                if (text.startsWith('X')) {
                    return true;
                } else {
                    return false;
                }
            },
            noteDelete(index) {
                this.dltNo = index;
                var text = this.lines[index];

                //setting the initial value
                if (text.startsWith('X')) {
                    this.isDeleted = true;
                } else {
                    this.isDeleted = false;
                }

                //toggling x
                if (text.startsWith('X')) {
                    this.isDeleted = false;
                    var x = text.replace('X ', '');
                    this.lines[index] = x;
                } else {
                    this.isDeleted = true;
                    this.lines[index] = 'X ' + text;
                }

                //saving
                this.editor = this.lines.join("\n");
                this.saveDb();

            },
            tabber(event) {
                if (event) {
                    let text = this.editor,
                        originalSelectionStart = event.target.selectionStart,
                        textStart = text.slice(0, originalSelectionStart),
                        textEnd = text.slice(originalSelectionStart);

                    this.editor = `${textStart}\t${textEnd}`;
                    event.target.value = this.editor;
                    event.target.selectionEnd = event.target.selectionStart = originalSelectionStart + 1;
                }
            },
            singleTabber(event) {
                if (event) {
                    let text = this.singleEditor,
                        originalSelectionStart = event.target.selectionStart,
                        textStart = text.slice(0, originalSelectionStart),
                        textEnd = text.slice(originalSelectionStart);

                    this.singleEditor = `${textStart}\t${textEnd}`;
                    event.target.value = this.singleEditor;
                    event.target.selectionEnd = event.target.selectionStart = originalSelectionStart + 1;
                }
            },
            toTxt() {
                var blob = new Blob([this.editor], {type: "text/plain;charset=utf-8"});
                FileSaver.saveAs(blob, this.noteName + ".txt");
            },
            toPdf() {
                window.print();
            },
            moveUp(array, indexA, indexB) {

                if (indexA == 0) {
                    return;
                }

                var tmp = array[indexA];
                array[indexA] = array[indexB];
                array[indexB] = tmp;
                this.listNo--;

                //rejoing after deleting
                this.editor = this.lines.join("\n");
                this.dltNo = null;
                this.toLines();
                this.saveDb();
            },
            moveDown(array, indexA, indexB) {
                if (indexA == this.totalList) {
                    return;
                }

                var tmp = array[indexA];
                array[indexA] = array[indexB];
                array[indexB] = tmp;

                this.listNo++;

                //rejoing after deleting
                this.editor = this.lines.join("\n");
                this.dltNo = null;
                this.toLines();
                this.saveDb();
            },
            toLines() {
                if (!this.editor == '') {
                    this.lists = true;

                    //remove blank space
                    var editor = this.editor.replace(/(^[ \t]*\n)/gm, "");

                    if (editor == '') {
                        return this.lists = false;
                    }

                    //split texts into lines
                    this.lines = editor.split("\n");
                    // this.lines = editor.split(/\n+/);
                }
            },
            toText() {
                this.lines[this.listNo] = this.singleEditor;
                this.editor = this.lines.join("\n");
                this.lines = this.editor.split(/\n+/);
                //console.log(this.lines);
            },
            currentList(index, event) {
                this.active = true;
                this.listNo = index;
                this.toggleEditor();

                //if shortcut insert (add before cursor)
                if (this.insertClicked) {
                    this.singleEditor = "\n" + this.lines[index];
                    return;
                } else if (this.hClicked) {
                    this.singleEditor = '## ' + "\n" + this.lines[index];
                    return;
                }

                this.singleEditor = this.lines[index];
            },
            editAll() {
                this.active = false;
                this.toggleEditor();
            },
            saveDb() {
                //save to database only
                axios.post('/note/update/' + this.note.slug, {
                    texts: this.editor,
                })
                    .catch((error) => {
                        console.log(error);
                        alert("Opps! your data didn't save.");
                    });
            },
            save() {
                if (this.active) {
                    this.toText();
                } else if (!this.active) {
                    this.toLines();
                }

                //count total list of array
                this.totalList = this.lines.length;

                this.toggleEditor();
                //update note
                axios.post('/note/update/' + this.note.slug, {
                    texts: this.editor,
                })
                    .catch((error) => {
                        console.log(error);
                        alert("Opps! your data didn't save.");
                    });
            },
            clearDone() {
                var array = this.lines.filter(function (item) {
                    return item.indexOf("X") !== 0;
                });

                //if editor is empty
                if (this.editor) {
                    this.lists = false;
                }

                this.editor = array.join("\n");
                this.dltNo = null;
                this.toLines();
                this.saveDb();
            },
            toggleEditor() {
                this.showEditor = !this.showEditor;
            },

        },
        computed: {
            searchNotes: function () {
                return this.lines.filter(list => {
                    return list.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        },
        mounted() {
            document.addEventListener("keydown", this.shortcut);
            this.editor = this.note.texts;
            this.noteName = this.note.name;
            this.toLines();
            this.totalList = this.lines.length;
        },
    };
</script>
