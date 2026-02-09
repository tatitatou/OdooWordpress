#-*- coding: utf-8 -*-
print(">>> lynxter_printer.py LOADED <<<")

from odoo import fields, models, api
import re
from odoo.exceptions import ValidationError
from datetime import date
from dateutil.relativedelta import relativedelta

class Printer(models.Model):
    _name = 'lynxter.printer'
    _description = 'Description of printer'

    active=fields.Boolean("Actif ?", default=True)
    serial_number = fields.Integer(string="Serial Number", required=True)
    manufacture_date = fields.Date(string="Manufacture date")
    sending_date = fields.Date(string="Sending date")
    age = fields.Integer(string="Age", compute="_age_printer")
    location = fields.Char("Location")
    model = fields.Selection([
        ('S600D', 'S600D'),
        ('S300X_FIL', 'S300X_FIL'),
        ('S300X_LIQ', 'S300X_LIQ'),
        ('S300X_PAS', 'S300X_PAS')
    ], string="Printer Model", required=True)
    thumbnail = fields.Binary("Thumbnail")

    building_status = fields.Selection([
        ('ordered', 'ordered'),
        ('work in progress', 'Work in progress'),
        ('stock', 'Stock'),
        ('sent', 'Sent')
    ], string="Building status", required=True, default='ordered')

    material_ids = fields.Many2many(
        'lynxter.material',
        string="Compatible materials"
    )

    toolhead_ids = fields.One2many(
        'lynxter.toolhead',
        'printer_id',
        string="printer toolheads"
    )

    @api.depends('manufacture_date')
    def _age_printer(self):
        for printer in self:
            TODAY = date.today()
            printer.age=relativedelta(TODAY,printer.manufacture_date).years