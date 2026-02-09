# -*- coding: utf-8 -*-
{
    'name': "lynxter",

    'summary': "Ceci est un module lynxter, qui permettra le stock des imprimantes 3D scpécifiques lynxter",

    'description': """
Ce module permet de gérer les imprimantes 3D de la marque Lynxter.
    """,

    'author': "Tatiana NOVION",
    'website': "https://www.yourcompany.com",

    # Categories can be used to filter modules in modules listing
    # Check https://github.com/odoo/odoo/blob/15.0/odoo/addons/base/data/ir_module_category_data.xml
    # for the full list
    'category': 'Inventory/printers',
    'version': '0.1',

    # any module necessary for this one to work correctly
    'depends': ['base', 'website'],

    'application': True,
    'license': 'AGPL-3',
    'images': ['static/description/lynxter_sas_logo.jpg'],

    # always loaded
    'data': [
        'security/lynxter_security.xml',
        'security/ir.model.access.csv',
        'views/views.xml',
        'views/lynxter_menu.xml',
        'views/templates.xml',
        'views/printer_views.xml',
        'views/material_views.xml',
        'views/toolhead_views.xml',
        'views/printer_kanban_views.xml',
        'views/printer_templates.xml'
    ],
    # only loaded in demonstration mode
    'demo': [
        'demo/printer.xml',
        'demo/material.xml',
        'demo/toolhead.xml'

    ],
}

