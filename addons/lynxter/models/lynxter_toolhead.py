from odoo import fields, models

class Toolhead(models.Model):
    _name = 'lynxter.toolhead'
    _description = 'Description of toolhead'

    name = fields.Char("Toolhead Name", required=True)
    type = fields.Selection([
        ('FIL', 'Filament'),
        ('LIQ', 'Liquid'),
        ('PAS', 'Paste')
    ], string="Toolhead Type", required=True)

    serial_number = fields.Char("Serial Number", required=True)

    printer_id = fields.Many2one(
        'lynxter.printer', 
        string="Printer"
    )