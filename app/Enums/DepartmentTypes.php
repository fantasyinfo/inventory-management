<?php

namespace App\Enums;

enum DepartmentTypes: string
{
    case ADMINISTRATION = 'administration';
    case CENTRAL_PLANNING = 'central planning';
    case CORPORATE_COMMUNICATIONS_CSR = 'corporate communications & csr';
    case DESIGN_DEVELOPMENT = 'design & development';
    case DIRECTORS_OFFICE = 'director\'s office';
    case ENVIRONMENT_HEALTH_SAFETY = 'environment, health & safety';
    case FINANCE_ACCOUNTS = 'finance & accounts';
    case HUMAN_RESOURCES = 'human resources';
    case INFORMATION_TECHNOLOGY_SAP = 'information technology & sap';
    case MAINTENANCE = 'maintenance';
    case MARKETING_BUSINESS_DEVELOPMENT = 'marketing & business development';
    case MANUFACTURING_EXCELLENCE = 'manufacturing excellence';
    case PPC = 'ppc';
    case PROCESS_ENGINEERING = 'process engineering';
    case PRODUCTION = 'production';
    case PROGRAM_MANAGEMENT = 'program management';
    case PURCHASE = 'purchase';
    case QUALITY_ASSURANCE = 'quality assurance';
    case SALES_DISPATCH_DOMESTIC = 'sales & dispatch - domestic';
    case SALES_DISPATCH_EXPORT = 'sales & dispatch - export';
    case SUPPLIER_QUALITY_ASSURANCE = 'supplier quality assurance';
    case STORE = 'store';
    case SUSTAINABILITY = 'sustainability';
    case VENDOR_DEVELOPMENT = 'vendor development';
    case STRATEGY_PLANNING = 'strategy & planning';
}
