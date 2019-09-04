const mutations = {
    setCompensation(state, compensation) {
        state.compensation.insuranceId = compensation.insurance_id;
        state.compensation.insuranceProvisionPeriodPlanMonth = compensation.insurance_provision_period_plan_month;
        state.compensation.insuranceProvisionPeriodPlanYear = compensation.insurance_provision_period_plan_year;
        state.compensation.insuranceProvisionPeriodPlanCompleted = compensation.insurance_provision_period_plan_completed === 1 ? true: false;
        state.compensation.totalProvisionPaid = compensation.total_provision_paid;
        state.compensation.provisionFeedback = compensation.provision_feedback;
        state.compensation.payoutRate = compensation.sales_compensations_payout_rate;
        state.compensation.salesCompensationFeedback = compensation.sales_compensation_feedback;
        state.compensation.insuranceId = compensation.insurance_id;
        state.compensation.salesCompensationPeriodPlanMonth = compensation.sales_compensations_period_plan_month;
        state.compensation.salesCompensationPeriodPlanYear = compensation.sales_compensations_period_plan_year;
        state.compensation.salesCompensationPeriodPlanCompleted = compensation.sales_compensations_period_plan_completed === 1 ? true : false;
        state.compensation.totalSalesCompensation = compensation.sales_compensations_total;

        state.compensation.salesOrder.id = compensation.sales_order_id;
        state.compensation.salesOrder.people = compensation.sales_order_people;
    },

    setSalesOrderId(state, value) {
        // since we only need the people and the sales order id
        state.compensation.salesOrder.id = value;
    },

    setCompensationId(state, value) {
        state.compensation.id = value;
    },

    setTotalSalesCompensations(state, value) {
        state.compensation.totalSalesCompensation = value;
    }
}

export default mutations;