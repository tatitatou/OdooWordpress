# -*- coding: utf-8 -*-
# from odoo import http


# class Lynxter(http.Controller):
#     @http.route('/lynxter/lynxter', auth='public')
#     def index(self, **kw):
#         return "Hello, world"

#     @http.route('/lynxter/lynxter/objects', auth='public')
#     def list(self, **kw):
#         return http.request.render('lynxter.listing', {
#             'root': '/lynxter/lynxter',
#             'objects': http.request.env['lynxter.lynxter'].search([]),
#         })

#     @http.route('/lynxter/lynxter/objects/<model("lynxter.lynxter"):obj>', auth='public')
#     def object(self, obj, **kw):
#         return http.request.render('lynxter.object', {
#             'object': obj
#         })

