# -*- coding: utf-8 -*-

from odoo import http


class PrinterController(http.Controller):

    @http.route('/lynxter/allprinters',type='http', auth='public',website=True)
    def printers_list(self, **kwargs):
        Printer = http.request.env['lynxter.printer']
        printers = Printer.search([])
        return http.request.render(
            'lynxter.printer_list_template',
            {
                'printers': printers
            }
        )


