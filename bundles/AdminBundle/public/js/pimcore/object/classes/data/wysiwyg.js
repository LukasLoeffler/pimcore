/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

pimcore.registerNS("pimcore.object.classes.data.wysiwyg");
/**
 * @private
 */
pimcore.object.classes.data.wysiwyg = Class.create(pimcore.object.classes.data.data, {

    type: "wysiwyg",
    /**
     * define where this datatype is allowed
     */
    allowIn: {
        object: true,
        objectbrick: true,
        fieldcollection: true,
        localizedfield: true,
        classificationstore : true,
        block: true,
        encryptedField: true
    },

    initialize: function (treeNode, initData) {
        this.type = "wysiwyg";

        this.initData(initData);

        // overwrite default settings
        this.availableSettingsFields = ["name","title","tooltip","mandatory","noteditable","invisible",
                                        "visibleGridView","visibleSearch","style"];

        this.treeNode = treeNode;
    },

    getTypeName: function () {
        return t("wysiwyg");
    },

    getGroup: function () {
            return "text";
    },

    getIconClass: function () {
        return "pimcore_icon_wysiwyg";
    },

    getLayout: function ($super) {

        $super();

        this.specificPanel.removeAll();
        var specificItems = this.getSpecificPanelItems(this.datax);
        this.specificPanel.add(specificItems);

        return this.layout;
    },

    getSpecificPanelItems: function (datax, inEncryptedField) {
        return [
            {
                xtype: "textfield",
                fieldLabel: t("width"),
                name: "width",
                value: datax.width
            },
            {
                xtype: "displayfield",
                hideLabel: true,
                value: t('width_explanation')
            },
            {
                xtype: "textfield",
                fieldLabel: t("height"),
                name: "height",
                value: datax.height
            },
            {
                xtype: "displayfield",
                hideLabel: true,
                value: t('height_explanation')
            },
            {
                xtype: "textarea",
                fieldLabel: t("editor_configuration"),
                name: "toolbarConfig",
                value: datax.toolbarConfig,
                width:400,
                height:150
            },
            {
                xtype: "checkbox",
                fieldLabel: t("exclude_from_search_index"),
                name: "excludeFromSearchIndex",
                checked: datax.excludeFromSearchIndex
            },
            {
                xtype: "textfield",
                fieldLabel: t("max_characters"),
                name: "maxCharacters",
                value: datax.maxCharacters
            }

        ];
    },

    applySpecialData: function(source) {
        if (source.datax) {
            if (!this.datax) {
                this.datax =  {};
            }
            Ext.apply(this.datax,
                {
                    width: source.datax.width,
                    height: source.datax.height,
                    toolbarConfig: source.datax.toolbarConfig,
                    excludeFromSearchIndex : source.datax.excludeFromSearchIndex,
                    maxCharacters : source.datax.maxCharacters
                });
        }
    }
});
