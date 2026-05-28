// resources/js/cms-inline-editor.js

(function () {
    window.cmsInlineEditor = function (config) {
        return {
            state: config.state,        // Livewire entangled waarde (string met JSON)
            paragraphs: [],             // [{ text: '...' }]
            focusIndex: null,

            // Blok-picker state
            showPicker: false,
            pickerIndex: null,
            pickerX: 0,
            pickerY: 0,
            // Voor nu wat dummy blokken – hier kun je later je eigen bloktypes inzetten
            blocks: [
                { key: 'paragraph', label: 'Paragraaf' },
                { key: 'image', label: 'Afbeelding blok' },
                { key: 'hero', label: 'Hero blok' },
            ],

            init() {
                this.loadFromState();

                if (!this.paragraphs.length) {
                    this.paragraphs = [{ text: '' }];
                }

                this.render();
                this.syncState();
            },

            loadFromState() {
                try {
                    if (typeof this.state === 'string' && this.state.trim().length) {
                        const doc = JSON.parse(this.state);
                        if (doc && Array.isArray(doc.content)) {
                            this.paragraphs = doc.content
                                .filter((n) => n.type === 'paragraph')
                                .map((n) => ({ text: n.text || '' }));
                        }
                    }
                } catch (e) {
                    console.warn('cmsInlineEditor: kon state niet parsen', e);
                }
            },

            syncState() {
                const doc = {
                    type: 'doc',
                    content: this.paragraphs.map((p) => ({
                        type: 'paragraph',
                        text: p.text || '',
                    })),
                };

                this.state = JSON.stringify(doc);
            },

            insertParagraph(index) {
                this.paragraphs.splice(index, 0, { text: '' });
                this.focusIndex = index;
                this.render();
                this.syncState();
            },

            updateParagraph(index, newText) {
                this.paragraphs[index].text = newText;
                this.syncState();
            },

            openPicker(index, event) {
                this.pickerIndex = index;

                const btnRect = event.currentTarget.getBoundingClientRect();
                const rootRect = this.$el.getBoundingClientRect();

                // Positie relatief aan de editor-container
                this.pickerX = btnRect.left - rootRect.left;
                this.pickerY = btnRect.bottom - rootRect.top + 4;

                this.showPicker = true;
            },

            closePicker() {
                this.showPicker = false;
                this.pickerIndex = null;
            },

            selectBlock(key) {
                // TODO: hier straks echte blok-logica
                // Voor nu:
                //  - paragraaf = nieuwe lege paragraaf
                //  - overige keys: ook gewoon nieuwe paragraaf (placeholder)
                if (this.pickerIndex === null) {
                    this.closePicker();
                    return;
                }

                // Later kun je hier switch(key) doen en bv. inline blokken pushen
                this.insertParagraph(this.pickerIndex + 1);

                this.closePicker();
            },

            render() {
                const root = this.$refs.editor;
                root.innerHTML = '';

                this.paragraphs.forEach((p, index) => {
                    const row = document.createElement('div');
                    row.className = 'cms-inline-row';

                    const textEl = document.createElement('div');
                    textEl.className = 'cms-inline-text';
                    textEl.setAttribute('contenteditable', 'true');
                    textEl.setAttribute('data-placeholder', 'Type hier...');
                    textEl.textContent = p.text || '';

                    textEl.addEventListener('input', (event) => {
                        this.updateParagraph(index, event.target.textContent || '');
                    });

                    textEl.addEventListener('keydown', (event) => {
                        if (event.key === 'Enter') {
                            event.preventDefault();
                            this.insertParagraph(index + 1);
                        }
                    });

                    const plusBtn = document.createElement('button');
                    plusBtn.type = 'button';
                    plusBtn.className = 'cms-inline-plus-btn';
                    plusBtn.innerText = '+';

                    plusBtn.addEventListener('click', (event) => {
                        event.preventDefault();
                        this.openPicker(index, event);
                    });

                    row.appendChild(textEl);
                    row.appendChild(plusBtn);
                    root.appendChild(row);

                    if (this.focusIndex === index) {
                        setTimeout(() => {
                            textEl.focus();
                            const range = document.createRange();
                            range.selectNodeContents(textEl);
                            range.collapse(false);
                            const sel = window.getSelection();
                            sel.removeAllRanges();
                            sel.addRange(range);
                        }, 0);
                    }
                });

                this.focusIndex = null;
            },
        };
    };
})();